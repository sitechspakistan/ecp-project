<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageComponents extends Model
{
    use HasFactory;

    protected $table = "pages_components";
    protected $fillable = ['page_id', 'title', 'type', 'meta', 'sort_order'];
    public $timestamps = false;

    public function setMetaAttribute($value)
    {
    	$this->attributes['meta'] = json_encode($value);
    }

    public function getMetaAttribute($value)
    {
    	return json_decode($value, true);
    }
}
