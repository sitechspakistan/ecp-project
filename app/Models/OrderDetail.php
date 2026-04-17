<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	protected $table = 'order_detail';
    protected $fillable = ['order_id', 'title', 'type', 'price','amount','qty','discount','original_price','offer_id','product_id','currency_symbol'];

    function item() {
        return $this->hasOne('App\Models\Products', 'id','product_id');
    }
    
    function orderMaster() {
        return $this->belongsTo('App\Models\Orders', 'order_id','id');
    }
}
