<?php

namespace App\Models;

use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    public const DISCOUNT_PERCENTAGE = 'percentage';

    public const DISCOUNT_FIXED = 'fixed';

    public const STATUS_ACTIVE = 'active';

    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'title',
        'code',
        'discount_type',
        'discount_value',
        'description',
        'show_on_website',
        'status',
        'is_blocked',
    ];

    protected function casts(): array
    {
        return [
            'show_on_website' => 'boolean',
            'is_blocked' => 'boolean',
            'discount_value' => 'decimal:2',
        ];
    }

    public function setCodeAttribute(?string $value): void
    {
        $this->attributes['code'] = $value !== null ? strtoupper(trim($value)) : null;
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'coupon_user');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategories::class, 'coupon_categories', 'coupon_id', 'category_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'coupon_products', 'coupon_id', 'product_id');
    }

    /**
     * Base gate: active and not blocked. Does not check assignment, catalog, or first-time rules.
     */
    public function isValid(?User $user = null): bool
    {
        return $this->status === self::STATUS_ACTIVE && $this->is_blocked === false;
    }

    /**
     * Whether the customer has never completed an order (any order row for this user).
     */
    public function isFirstTimeUser(?User $user): bool
    {
        if ($user === null) {
            return false;
        }

        return ! Orders::query()->where('user_id', $user->id)->exists();
    }

    /**
     * When coupon_user has rows, only those users may use the coupon.
     * When empty, any user (subject to other rules) may use it.
     */
    public function isAssignedToUser(?User $user): bool
    {
        if (! $this->users()->exists()) {
            return true;
        }

        if ($user === null) {
            return false;
        }

        return $this->users()->where('users.id', $user->id)->exists();
    }

    public function isApplicableToProduct(int $productId): bool
    {
        $hasProducts = $this->products()->exists();
        $hasCategories = $this->categories()->exists();

        if (! $hasProducts && ! $hasCategories) {
            return true;
        }

        $product = Products::query()->find($productId);
        if (! $product) {
            return false;
        }

        if ($hasProducts && $hasCategories) {
            $inProducts = $this->products()->where('products.id', $productId)->exists();
            $inCategories = $this->categories()->where('product_categories.id', $product->category_id)->exists();

            return $inProducts || $inCategories;
        }

        if ($hasProducts) {
            return $this->products()->where('products.id', $productId)->exists();
        }

        return $this->categories()->where('product_categories.id', $product->category_id)->exists();
    }

    /**
     * Subtotal after discount (never negative).
     */
    public function applyDiscount(float|string $amount): float
    {
        $amount = (float) $amount;
        if ($amount <= 0) {
            return 0.0;
        }

        $discount = $this->getDiscountAmountForSubtotal($amount);

        return max(0, round($amount - $discount, 2));
    }

    public function getDiscountAmountForSubtotal(float|string $amount): float
    {
        $amount = (float) $amount;
        if ($amount <= 0) {
            return 0.0;
        }

        if ($this->discount_type === self::DISCOUNT_PERCENTAGE) {
            return round($amount * ((float) $this->discount_value / 100), 2);
        }

        return round(min((float) $this->discount_value, $amount), 2);
    }

    /**
     * First-time-only coupons: enable when is_first_time_only column is added, or override in a custom model.
     */
    public function requiresFirstTimeOnly(): bool
    {
        return isset($this->attributes['is_first_time_only']) && (bool) $this->attributes['is_first_time_only'];
    }
}
