<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'memberships';

    protected $fillable = [
        'code',
        'title',
        'description',
        'btn_txt',
        'price',
        'duration_value',
        'duration_type',
        'user_type',
        'is_active',
        'is_default',
        'is_featured_eligible',
    ];

    protected $casts = [
        'price' => 'float',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'is_featured_eligible' => 'boolean',
    ];
}
