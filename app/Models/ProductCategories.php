<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class ProductCategories extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    protected $fillable = [ 'category_type','title', 'slug', 'short_description', 'sort_order', 'is_active', 'meta_title', 'meta_desc','seo_meta', 'image'];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'ProductCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created product category: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'ProductCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated product category: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'ProductCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted product category: {$post->title}",
            ]);
        });
    }
    /* User Log */

    public function setLinkCanonicalsAttribute($value)
    {
    	$this->attributes['link_canonicals'] = json_encode($value);
    }

    public function getLinkCanonicalsAttribute($value)
    {
    	return json_decode($value);
    }
    
    public function setSeoMetaAttribute($value)
    {
    	$this->attributes['seo_meta'] = json_encode($value);
    }

    public function getSeoMetaAttribute($value)
    {
    	return json_decode($value, true);
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'category_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_categories', 'category_id', 'coupon_id');
    }
}
