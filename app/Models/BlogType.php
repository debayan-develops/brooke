<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogType extends Model
{
    protected $table = 'blog_type';
    protected $fillable = [
        'type_name',
    ];
}
