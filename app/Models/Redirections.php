<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLog;

class Redirections extends Model
{
    use HasFactory;

    protected $table = 'redirections';
    protected $fillable = ['url', 'redirect_url', 'is_active'];

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'Redirections',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created redirection",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Redirections',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated redirection",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Redirections',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted redirection",
            ]);
        });
    }
    /* User Log */
}
