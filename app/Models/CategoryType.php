<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Content\Domain\Models\ContentCategory;
use App\Models\Character;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryType extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name'];

    protected $table = 'category_type';

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ContentCategory::class, 'category_type_map', 'category_type_id', 'content_category_id')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_type_map', 'category_type_id', 'tag_id')->withTimestamps();
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_type_map', 'category_type_id', 'character_id')->withTimestamps();
    }

    public function shortStories() {
    return $this->belongsToMany(ShortStories::class, 'short_story_categories', 'category_id', 'short_story_id');
}

}
