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
}