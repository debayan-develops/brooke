<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryType;
use App\Admin\Content\Domain\Models\ContentCategory;
use Illuminate\Support\Str;

class ShortStoryContentCategorySeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure the "Short Story" Category Type exists
        $type = CategoryType::firstOrCreate(
            ['slug' => 'short-story'],
            ['name' => 'Short Story']
        );

        // 2. The list of categories you requested
        $categories = [
            'Novel Related', 'Biblical', 'Personal', 'Misc', 'Faith',
            'Politics', 'Health', 'Family', 'Parenting', 'Finance',
            'Church Ministry', 'Business & Leadership', 'Women',
            'Talk Shows', 'Sermons'
        ];

        // 3. Create each category and link it to the Short Story Type
        foreach ($categories as $catName) {
            // Create the category in content_categories table
            $category = ContentCategory::firstOrCreate([
                'name' => $catName,
                // 'id' is UUID, handled automatically by the model usually, 
                // if not we rely on the model's boot method or DB default.
            ]);

            // Link it to the "short-story" type (Many-to-Many)
            // This populates the category_type_map table
            if (!$type->categories()->where('content_category_id', $category->id)->exists()) {
                $type->categories()->attach($category->id);
            }
        }
    }
}