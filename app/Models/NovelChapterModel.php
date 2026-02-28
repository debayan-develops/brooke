<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NovelChapterModel extends Model
{
    protected $table = 'novel_chapters';

    protected $fillable = [
        'novel_id',
        'title',
        'description',
        'chapter_number',
        'is_active'
    ];

    // Optional: Reverse link back to Novel
    public function novel()
    {
        return $this->belongsTo(NovelModel::class, 'novel_id');
    }
    // Add this relationship to link a chapter to its slider images
    public function sliderImages()
    {
        return $this->hasMany(\App\Models\NovelChapterSliderImagesModel::class, 'novel_chapter_id');
    }
}