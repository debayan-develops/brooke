<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogSlider extends Model
{
    protected $table = 'blog_slider';
    protected $fillable = [
        'blog_id',
        'image_path',
    ];
}
