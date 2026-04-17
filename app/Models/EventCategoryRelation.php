<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategoryRelation extends Model
{
    use HasFactory;
    
    protected $table = 'event_category_relation';
    protected $fillable = [ 'event_id', 'category_id' ];
    public $timestamps = false;

    public function events()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
