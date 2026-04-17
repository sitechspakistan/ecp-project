<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class EventCategories extends Model
{
    use HasFactory;

    protected $table = 'event_categories';
    protected $fillable = [ 'title', 'slug', 'short_description', 'sort_order', 'is_active' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'EventCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created event category: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'EventCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated event category: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'EventCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted event category: {$post->title}",
            ]);
        });
    }
    /* User Log */

    public function events()
    {
        return $this->hasMany(EventCategoryRelation::class, 'category_id');
    }
}
