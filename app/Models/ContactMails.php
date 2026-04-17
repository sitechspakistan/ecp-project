<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMails extends Model
{
    use HasFactory;
    
    protected $table = 'contact_mails';
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'fields_meta'];

    public function setFieldsMetaAttribute($value)
    {
    	$this->attributes['fields_meta'] = json_encode($value);
    }

    public function getFieldsMetaAttribute($value)
    {
    	return json_decode($value, true);
    }

}
