<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany; // <--- Import this
use App\Admin\Content\Domain\Models\ContentCategory;

class ShortStories extends Model
{
    protected $table = 'short_story';
    protected $fillable = [
        'title',
        'short_description',
        'thumbnail_photo',
        'short_story_details',
        'status',
        'created_by',
        'updated_by',
    ];

    public function shortStoryCategories(): BelongsToMany
    {
        return $this->belongsToMany(ContentCategory::class, 'short_story_categories', 'short_story_id', 'category_id')->withTimestamps();
    }
    
    public function shortStoryTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'short_story_tags', 'short_story_id', 'tag_id')->withTimestamps();
    }
    
    public function shortStoryCharacters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'short_story_characters', 'short_story_id', 'character_id')->withTimestamps();
    }
    
    public function suggestedStories(): BelongsToMany
    {
        return $this->belongsToMany(
            ShortStories::class,          
            'suggested_stories',        
            'short_story_id',           
            'suggested_story_id'        
        );
    }

    // ▼▼▼ ADD THIS FUNCTION ▼▼▼
    // In App\Models\ShortStories.php

     public function sliderImages()
    {
    // This matches the 'short_story_id' in your database table automatically
    return $this->hasMany(\App\Models\shortStorySlider::class, 'short_story_id');
    }
    // ▲▲▲ END ADDITION ▲▲▲

}