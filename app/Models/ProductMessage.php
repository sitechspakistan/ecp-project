<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMessage extends Model
{
    use HasFactory;

    protected $table = 'product_messages';
    protected $fillable = [ 'product_id','product_user_id','message','user_id', 'type', 'offer', 'status'];

    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function productuser()
    {
        return $this->hasOne(User::class, 'id', 'product_user_id');
    }

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'ProductMessages',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created product message",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'ProductMessages',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated product message",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'ProductMessages',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted product message",
            ]);
        });
    }
    /* User Log */
}
