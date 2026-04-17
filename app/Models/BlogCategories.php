<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class BlogCategories extends Model
{
    use HasFactory;

    protected $table = 'blog_categories';
    protected $fillable = [ 'title', 'slug', 'short_description', 'sort_order', 'is_active' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'BlogCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created blog category: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'BlogCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated blog category: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'BlogCategories',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted blog category: {$post->title}",
            ]);
        });
    }
    /* User Log */

    public function blogs()
    {
        return $this->hasMany(BlogCategoryRelation::class, 'category_id');
    }
}
