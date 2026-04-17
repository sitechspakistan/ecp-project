<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupModules extends Model
{
    use HasFactory;

    protected $table = "group_modules";
    protected $fillable = ['group_id', 'module', '_show', '_create', '_edit', '_delete'];
    public $timestamps = false;
}
