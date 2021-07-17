<?php

namespace App\Models;

use App\Models\{User, Category,Tag,Comment};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','slug','body','image','category_id'];
    use HasFactory;

    public function getTakeImgAttribute()
    {
        return '/storage/'.$this->image;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
