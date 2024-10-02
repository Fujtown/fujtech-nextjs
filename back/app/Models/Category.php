<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    // Automatically create slug from title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->title);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->title);
        });
    }

    // Relationship with posts (assuming you have a Post model)
    public function posts()
    {
        return $this->hasMany(Blog::class);
    }
}
