<?php

namespace App\Admin\Content\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContentCategory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'created_by', 'updated_by'];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(CategoryType::class, 'category_type_map', 'content_category_id', 'category_type_id')->withTimestamps();
    }

}
