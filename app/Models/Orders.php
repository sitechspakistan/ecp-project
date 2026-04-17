<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = [
    	'order_no', 'user_id', 'session', 'order_total_amount', 'order_note', 'order_status','payment_type','payment_info','shipping', 'order_type', 'membership_details'
    ];

    function user() {
        return $this->hasOne('App\Models\User', 'id','user_id');
    }


    function orderdetail() {
        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }

    

    public function setShippingAttribute($value)
	{
		$this->attributes['shipping'] = json_encode($value);
	}

    public function getShippingAttribute($value)
    {
        $date = json_decode($value,true);
        return $date;
    }
    
    public function setMembershipDetailsAttribute($value)
	{
		$this->attributes['membership_details'] = json_encode($value);
	}

    public function getMembershipDetailsAttribute($value)
    {
        $date = json_decode($value,true);
        return $date;
    }
}