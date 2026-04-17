<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Testimonials extends Model
{
    use HasFactory;

    protected $table = 'testimonials';
    protected $fillable = [ 'name', 'designation', 'testimonial', 'image', 'is_active', 'sort_order' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Testimonials',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created testimonial: {$post->name}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Testimonials',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated testimonial: {$post->name}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Testimonials',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted testimonial: {$post->name}",
            ]);
        });
    }
    /* User Log */
}
