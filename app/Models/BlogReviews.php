<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class BlogReviews extends Model
{
    use HasFactory;

    protected $table = 'blog_reviews';
    protected $fillable = [ 'blog_id', 'name', 'email', 'review', 'rating', 'title', 'created_by'];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Products',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created product: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Products',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated product: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Products',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted product: {$post->title}",
            ]);
        });
    }
    /* User Log */
}
