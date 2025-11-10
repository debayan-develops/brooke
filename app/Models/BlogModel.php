<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Content\Domain\Models\ContentCategory;

class BlogModel extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        // 'short_description',
        'thumbnail_photo',
        'blog_details',
        'status',
        'created_by',
        'updated_by',
    ];

    public function blogTypes()
    {
        return $this->belongsToMany(BlogType::class, 'blog_type_map', 'blog_id', 'type_id')->withTimestamps();
    }

    public function blogCategories()
    {
        return $this->belongsToMany(ContentCategory::class, 'blog_category_map', 'blog_id', 'category_id')->withTimestamps();
    }

    public function blogTags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag_map', 'blog_id', 'tag_id')->withTimestamps();
    }

    public function suggestedBlogs()
    {
        return $this->belongsToMany(
            BlogModel::class,          // Related model
            'suggested_blog',        // Pivot table
            'blog_id',           // FK on pivot
            'suggested_blog_id'        // Related FK
        );
    }
}
