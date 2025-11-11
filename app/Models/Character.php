<?php

// app/Models/Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(CategoryType::class, 'character_type_map', 'character_id', 'category_type_id')->withTimestamps();
    }

    public function shortStoryCharacters(): BelongsToMany
    {
        return $this->belongsToMany(ShortStories::class, 'short_story_characters', 'character_id', 'short_story_id')->withTimestamps();
    }

    // public function shortStories(): BelongsToMany
    // {
    //     return $this->belongsToMany(CategoryType::class, 'character_type_map', 'character_id', 'category_type_id')
    //                 ->withTimestamps()
    //                 ->where('category_type.slug', 'short-story');
    // }

}
