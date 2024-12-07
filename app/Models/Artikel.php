<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model  
{  
    use HasFactory;  
    protected $table = 'articles';
    protected $fillable = ['title', 'full_text', 'image', 'user_id', 'category_id'];  

    public function user()  
    {  
        return $this->belongsTo(User::class);  
    }  

    public function category()  
    {  
        return $this->belongsTo(Category::class);  
    }  

    public function tags()  
    {  
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');  
    }  
}  
