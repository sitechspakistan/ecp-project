<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserLog;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'group_id',
        'user_type',
        'is_active',
        'phone',
        'dob',
        'address',
        'city',
        'state',
        'country',
        'postal',
        'image',
        'membership_id',
        'start_date',
        'expiry_date',
        'membership_title'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function group()
    {
        return $this->hasOne(UserGroups::class, 'id','group_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'user_id');
    }

    /* User Log */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'model' => 'User',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Created user: {$post->name}",
            ]);
        });

        static::updated(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'User',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Updated user: {$post->name}",
            ]);
        });

        static::deleted(function ($post) {
            UserLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'User',
                'model_id' => $post->id,
                'user_ip'=>request()->ip(),
                'description' => "Deleted user: {$post->name}",
            ]);
        });
    }
    /* User Log */
}
