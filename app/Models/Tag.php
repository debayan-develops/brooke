<?php

// app/Models/Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(CategoryType::class, 'tags_type_map', 'tag_id', 'category_type_id')->withTimestamps();
    }
}
