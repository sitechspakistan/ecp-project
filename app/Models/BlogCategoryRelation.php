<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryRelation extends Model
{
    use HasFactory;
    
    protected $table = 'blog_category_relation';
    protected $fillable = [ 'blog_id', 'category_id' ];
    public $timestamps = false;

    public function blogs()
    {
        return $this->belongsTo(Blogs::class, 'blog_id');
    }
}
