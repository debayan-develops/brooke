<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Content\Domain\Models\ContentCategory;
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

}
