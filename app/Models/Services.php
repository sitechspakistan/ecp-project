<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [ 'title', 'slug', 'parent_id', 'image', 'description', 'meta_title', 'meta_description', 'og_image', 'meta', 'sort_order', 'is_active', 'link_canonicals', 'seo_meta', 'schema_code' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Services',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created service: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Services',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated service: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Services',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted service: {$post->title}",
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
    
    public function parent()
	{
	    return $this->hasOne($this, 'id','parent_id');
	}

    public function childrens()
	{
	    return $this->hasMany($this, 'parent_id');
	}
}
