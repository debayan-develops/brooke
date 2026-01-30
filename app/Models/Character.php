<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    protected $table = 'characters';
    protected $fillable = ['name', 'description'];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(CategoryType::class, 'character_type_map', 'character_id', 'category_type_id');
    }
    public function stories()
    {
        // This connects the Character to ShortStories via the pivot table
        return $this->belongsToMany(\App\Models\ShortStories::class, 'short_story_characters', 'character_id', 'short_story_id');
    }
}