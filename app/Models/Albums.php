<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Albums extends Model
{
    use HasFactory;

    protected $table = 'albums';
    protected $fillable = [ 'title', 'slug', 'description', 'image', 'gallery', 'album_date', 'is_active' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Albums',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created album: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Albums',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated album: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Albums',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted album: {$post->title}",
            ]);
        });
    }
    /* User Log */

    public function setGalleryAttribute($value)
    {
    	$this->attributes['gallery'] = json_encode($value);
    }

    public function getGalleryAttribute($value)
    {
    	return json_decode($value);
    }
}
