<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = ['title', 'is_primary', 'is_secondary'];

    function items() {
        return $this->hasMany('App\Models\MenuItems', 'menu_id')->OrderBy('sort_order');
    }
}
