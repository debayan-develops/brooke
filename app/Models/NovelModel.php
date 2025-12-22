<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NovelModel extends Model
{
    protected $table = 'novels';
    protected $fillable = [
        'permission',
        'title',
        'description',
        'about_story',
        'author',
        'thumbnail',
        'banner_image',
        'status',
        'created_by',
        'updated_by',
    ];

    // Define relationships
    public function novelTags()
    {
        return $this->belongsToMany(Tag::class, 'novel_tag', 'novel_id', 'tag_id');
    }

    public function suggestedNovels()
    {
        return $this->belongsToMany(NovelModel::class, 'related_novel', 'novel_id', 'related_novel_id');
    }
}
