<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $table = 'user_logs';
    protected $fillable = ['user_id', 'action', 'model', 'model_id', 'description', 'user_ip'];

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
