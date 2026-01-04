<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NovelChapterModel; // Import the Chapter Model
use App\Models\Tag;

class NovelModel extends Model
{
    protected $table = 'novels';
    
    // Ensure this matches the model name in other relationships
    // If your other models try to link to 'Novel', you might need to check that.
    
    protected $fillable = [
        'permission',
        'title',
        'description',
        'about_story',
        'permission',
        'author',
        'thumbnail',
        'banner_image',
        'status',
        'created_by',
        'updated_by',
    ];

    // --- EXISTING RELATIONSHIPS ---
    public function novelTags()
    {
        return $this->belongsToMany(Tag::class, 'novel_tag', 'novel_id', 'tag_id');
    }

    public function suggestedNovels()
    {
        return $this->belongsToMany(NovelModel::class, 'related_novel', 'novel_id', 'related_novel_id');
    }

    // --- NEW FIXES (The Missing Links) ---

    // 1. Link to Chapters (Fixes the "count() on null" error)
    public function chapters()
    {
        return $this->hasMany(NovelChapterModel::class, 'novel_id');
    }

    // 2. Alias for 'tags' (Matches our Controller code)
    public function tags()
    {
        return $this->novelTags();
    }

    // 3. Alias for 'relatedNovels' (Matches our Controller code)
    public function relatedNovels()
    {
        return $this->suggestedNovels();
    }
}