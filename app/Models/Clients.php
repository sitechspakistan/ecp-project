<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Clients extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = [ 'title', 'image', 'link', 'is_active', 'sort_order' ];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Clients',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created client: {$post->title}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Clients',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated client: {$post->title}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Clients',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted client: {$post->title}",
            ]);
        });
    }
    /* User Log */
}
