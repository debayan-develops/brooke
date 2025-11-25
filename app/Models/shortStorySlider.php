<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shortStorySlider extends Model
{
    protected $table = 'short_story_slider';
    protected $fillable = [
        'short_story_id',
        'image_path',
    ];
}
