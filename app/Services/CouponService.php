<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    public function findByCode(string $code): ?Coupon
    {
        $normalized = strtoupper(trim($code));

        return Coupon::query()->where('code', $normalized)->first();
    }

    /**
     * @param  array<int>  $productIds
     * @return array{valid: bool, message: string|null, coupon: Coupon|null, errors: array<int, string>}
     */
    public function validateCouponCode(string $code, ?User $user, float $subtotal = 0, array $productIds = []): array
    {
        $coupon = $this->findByCode($code);
        if (! $coupon) {
            return [
                'valid' => false,
                'message' => __('Invalid or unknown coupon code.'),
                'coupon' => null,
                'errors' => ['invalid_code'],
            ];
        }

        if (! $coupon->isValid($user)) {
            $errors = [];
            if ($coupon->is_blocked) {
                $errors[] = 'blocked';
            }
            if ($coupon->status !== Coupon::STATUS_ACTIVE) {
                $errors[] = 'inactive';
            }
            if ($errors === []) {
                $errors[] = 'not_valid';
            }

            return [
                'valid' => false,
                'message' => __('This coupon cannot be used.'),
                'coupon' => $coupon,
                'errors' => $errors,
            ];
        }

        if (! $coupon->isAssignedToUser($user)) {
            return [
                'valid' => false,
                'message' => __('This coupon is not available for your account.'),
                'coupon' => $coupon,
                'errors' => ['user_not_assigned'],
            ];
        }

        if ($coupon->requiresFirstTimeOnly() && ! $coupon->isFirstTimeUser($user)) {
            return [
                'valid' => false,
                'message' => __('This coupon is only available for first-time customers.'),
                'coupon' => $coupon,
                'errors' => ['not_first_time'],
            ];
        }

        foreach ($productIds as $pid) {
            if (! $coupon->isApplicableToProduct((int) $pid)) {
                return [
                    'valid' => false,
                    'message' => __('This coupon does not apply to one or more items in your cart.'),
                    'coupon' => $coupon,
                    'errors' => ['product_not_applicable'],
                ];
            }
        }

        if ($subtotal > 0) {
            $final = $coupon->applyDiscount($subtotal);
            if ($final >= $subtotal) {
                return [
                    'valid' => false,
                    'message' => __('This coupon does not change the order total.'),
                    'coupon' => $coupon,
                    'errors' => ['no_discount'],
                ];
            }
        }

        return [
            'valid' => true,
            'message' => null,
            'coupon' => $coupon,
            'errors' => [],
        ];
    }

    /**
     * @param  array<int>  $productIds
     * @return array{success: bool, message: string|null, subtotal: float, discount_amount: float, final_total: float, coupon: Coupon|null}
     */
    public function applyToSubtotal(string $code, float $subtotal, array $productIds = [], ?User $user = null): array
    {
        $user = $user ?? Auth::user();

        $check = $this->validateCouponCode($code, $user, $subtotal, $productIds);
        if (! $check['valid'] || ! $check['coupon'] instanceof Coupon) {
            return [
                'success' => false,
                'message' => $check['message'],
                'subtotal' => round($subtotal, 2),
                'discount_amount' => 0.0,
                'final_total' => round($subtotal, 2),
                'coupon' => $check['coupon'],
            ];
        }

        $coupon = $check['coupon'];
        $discountAmount = $coupon->getDiscountAmountForSubtotal($subtotal);
        $final = $coupon->applyDiscount($subtotal);

        return [
            'success' => true,
            'message' => null,
            'subtotal' => round((float) $subtotal, 2),
            'discount_amount' => $discountAmount,
            'final_total' => $final,
            'coupon' => $coupon,
        ];
    }
}
