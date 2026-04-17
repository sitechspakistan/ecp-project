<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Pages extends Model
{
    use HasFactory;

    protected $table = "pages";
    protected $fillable = ['title', 'slug', 'parent_id', 'sitemap', 'meta_title', 'meta_desc', 'meta_keywords', 'og_image', 'is_home', 'show_title', 'header_image', 'custom_css', 'link_canonicals', 'schema_code', 'seo_meta', 'is_active', 'is_login', 'memberships'] ;

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Pages',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created page: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Pages',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated page: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Pages',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted page: {$post->title}",
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
    
    public function setMembershipsAttribute($value)
    {
    	$this->attributes['memberships'] = json_encode($value);
    }

    public function getMembershipsAttribute($value)
    {
    	return json_decode($value, true);
    }

    public function parent()
    {
        return $this->hasOne($this, 'id','parent_id');
    }
}
