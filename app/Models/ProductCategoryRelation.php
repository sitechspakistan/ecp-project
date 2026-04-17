<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryRelation extends Model
{
    use HasFactory;
    
    protected $table = 'product_category_relation';
    protected $fillable = [ 'product_id', 'category_id' ];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
