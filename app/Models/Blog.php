<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; 

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail_image',
        'publish_date',
        'author',
        'status'
    ];

    // Relationship: A Blog has many Slider Images
    public function images()
    {
        return $this->hasMany(BlogImage::class, 'blog_id');
    }

    // Relationship: A Blog belongs to many Categories
    public function categories()
    {
        // We use the pivot table 'blog_category_relations' defined in your seeder
        return $this->belongsToMany(BlogCategory::class, 'blog_category_relations', 'blog_id', 'blog_category_id');
    }
}