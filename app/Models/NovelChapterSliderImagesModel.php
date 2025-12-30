<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class novelChapterSliderImagesModel extends Model
{
    protected $table = 'novel_chapter_slider_images';

    protected $fillable = [
        'novel_chapter_id',
        'image_path',
        'title',
        'is_active'
    ];
}
