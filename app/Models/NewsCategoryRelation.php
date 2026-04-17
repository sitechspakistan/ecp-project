<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategoryRelation extends Model
{
    use HasFactory;
    
    protected $table = 'news_category_relation';
    protected $fillable = [ 'news_id', 'category_id' ];
    public $timestamps = false;

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

}
