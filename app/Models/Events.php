<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Events extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [ 'title', 'slug', 'image', 'short_description', 'description', 'meta_title', 'meta_description', 'og_image', 'meta', 'sort_order', 'is_featured', 'views_count', 'is_active', 'link_canonicals', 'publish_date', 'venue', 'schema_code', 'seo_meta', 'author' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Events',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created event: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Events',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated event: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Events',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted event: {$post->title}",
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
        return $this->belongsToMany(EventCategories::class, 'event_category_relation', 'event_id', 'category_id');
    }

    public function eventCategoryRelations()
    {
        return $this->hasMany(EventCategoryRelation::class, 'event_id');
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
