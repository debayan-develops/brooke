<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];

    // FIX: Explicitly define 'category_type_id' as the related key
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(CategoryType::class, 'tags_type_map', 'tag_id', 'category_type_id');
    }
}