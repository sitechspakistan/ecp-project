<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [ 'title', 'slug', 'image', 'short_description', 'description', 'meta_title', 'meta_description', 'og_image', 'meta', 'sort_order', 'is_featured', 'views_count', 'is_active', 'link_canonicals', 'publish_date', 'seo_meta', 'schema_code', 'author','user_id' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Blogs',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created blog: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Blogs',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated blog: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Blogs',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted blog: {$post->title}",
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

    public function categories()
    {
        return $this->belongsToMany(BlogCategories::class, 'blog_category_relation', 'blog_id', 'category_id');
    }

    public function blogCategoryRelations()
    {
        return $this->hasMany(BlogCategoryRelation::class, 'blog_id');
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
}
