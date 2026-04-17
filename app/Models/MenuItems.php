<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;

    protected $table = 'menu_items';
    protected $fillable = ['menu_id', 'title', 'type', 'slug', 'url', 'megamenu_id', 'parent', 'sort_order', 'icon', 'new_window'];
    public $timestamps = false;

    public function childrens()
	{
	    return $this->hasMany($this,'parent');
	}
}
