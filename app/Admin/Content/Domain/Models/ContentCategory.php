<?php

namespace App\Admin\Content\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryType;
use App\Models\ShortStories;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContentCategory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'created_by', 'updated_by'];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(CategoryType::class, 'category_type_map', 'content_category_id', 'category_type_id')->withTimestamps();
    }

    public function shortStoryCategories(): BelongsToMany
    {
        return $this->belongsToMany(ShortStories::class, 'short_story_categories', 'category_id', 'short_story_id')->withTimestamps();
    }

}
