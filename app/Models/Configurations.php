<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Configurations extends Model
{
    use HasFactory;

    protected $table = 'configurations';
    protected $fillable = [ 'topbar_meta', 'footer_meta', 'social_meta', 'contact_meta', 'contact_mails', 'blogs_seo', 'events_seo', 'news_seo', 'sidebar_meta', 'tracking_code', 'robot', 'watermark'];
    public $timestamps = false;

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Configurations',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated configurations",
            ]);
        });
        
    }
    /* User Log */

    public function setTopbarMetaAttribute($value)
    {
    	$this->attributes['topbar_meta'] = json_encode($value);
    }

    public function getTopbarMetaAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setFooterMetaAttribute($value)
    {
    	$this->attributes['footer_meta'] = json_encode($value);
    }

    public function getFooterMetaAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setSocialMetaAttribute($value)
    {
    	$this->attributes['social_meta'] = json_encode($value);
    }

    public function getSocialMetaAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setContactMetaAttribute($value)
    {
    	$this->attributes['contact_meta'] = json_encode($value);
    }

    public function getContactMetaAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setContactMailsAttribute($value)
    {
    	$this->attributes['contact_mails'] = json_encode($value);
    }

    public function getContactMailsAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setBlogsSeoAttribute($value)
    {
    	$this->attributes['blogs_seo'] = json_encode($value);
    }

    public function getBlogsSeoAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setEventsSeoAttribute($value)
    {
    	$this->attributes['events_seo'] = json_encode($value);
    }

    public function getEventsSeoAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setNewsSeoAttribute($value)
    {
    	$this->attributes['news_seo'] = json_encode($value);
    }

    public function getNewsSeoAttribute($value)
    {
    	return json_decode($value, true);
    }
    
    public function setSidebarMetaAttribute($value)
    {
    	$this->attributes['sidebar_meta'] = json_encode($value);
    }

    public function getSidebarMetaAttribute($value)
    {
    	return json_decode($value, true);
    }
}
