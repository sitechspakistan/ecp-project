<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class NewsCategories extends Model
{
    use HasFactory;

    protected $table = 'news_categories';
    protected $fillable = [ 'title', 'slug', 'short_description', 'sort_order', 'is_active' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'NewsCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created news category: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'NewsCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated news category: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'NewsCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted news category: {$post->title}",
            ]);
        });
    }
    /* User Log */

    public function news()
    {
        return $this->hasMany(NewsCategoryRelation::class, 'category_id');
    }
}
