<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Admin\Content\Domain\Models\CategoryType as Type;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Blog', 'slug' => 'blog'],
            ['name' => 'Novel', 'slug' => 'novel'],
            ['name' => 'Short Story', 'slug' => 'short-story'],
            // ['name' => 'Poetry', 'slug' => 'poetry'],
        ];

        foreach ($types as $type) {
            Type::firstOrCreate(['slug' => $type['slug']], $type);
        }

    }
}
