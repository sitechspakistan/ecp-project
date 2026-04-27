<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [ 'title', 'slug', 'image', 'short_description', 'description', 'meta_title', 'meta_description', 'meta', 'sort_order', 'is_featured', 'views_count', 'is_active', 'seo_meta', 'schema_code', 'cost_price', 'sell_price', 'category_id', 'quantity','gender','age','color_markings','potential','champion_bloodlines','champion_sired','champion_sired','vaccinations','health_certificate', 'health_record', 'health_warranty', 'product_listing', 'photo_date', 'shipping', 'size', 'avaiable_color', 'state_id', 'location_id', 'gallery', 'created_by', 'rating', 'user_id' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Products',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created product: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Products',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated product: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Products',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted product: {$post->title}",
            ]);
        });
    }
    /* User Log */

    public function setSeoMetaAttribute($value)
    {
    	$this->attributes['seo_meta'] = json_encode($value);
    }

    public function getSeoMetaAttribute($value)
    {
    	return json_decode($value, true);
    }

    public function category()
    {
        return $this->hasOne(ProductCategories::class, 'id', 'category_id');
    }

    public function location()
    {
        return $this->hasOne(Cities::class, 'id', 'location_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReviews::class, 'product_id', 'id');
    }

    public function bookmarks()
    {
        return $this->hasMany(ProductBookmark::class, 'product_id', 'id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_products', 'product_id', 'coupon_id');
    }

    public function setLinkCanonicalsAttribute($value)
    {
    	$this->attributes['link_canonicals'] = json_encode($value);
    }

    public function getLinkCanonicalsAttribute($value)
    {
    	return json_decode($value);
    }

    public function setMetaAttribute($value)
    {
    	$this->attributes['meta'] = json_encode($value);
    }

    public function getMetaAttribute($value)
    {
    	return json_decode($value);
    }

    public function setGalleryAttribute($value)
    {
    	$this->attributes['gallery'] = json_encode($value);
    }

    public function getGalleryAttribute($value)
    {
    	return json_decode($value, true);
    }
}
