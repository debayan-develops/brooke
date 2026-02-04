<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Dummy Categories if they don't exist
        $categories = ['Process', 'Reflection', 'Epiphany', 'Updates', 'Writing'];
        $catIds = [];
        
        foreach ($categories as $cat) {
            $id = DB::table('blog_categories')->insertGetId([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $catIds[] = $id;
        }

        // 2. Create 10 Dummy Blog Posts
        for ($i = 1; $i <= 10; $i++) {
            $title = "The Journey from Hardcopy to Semi-Digital Pt. " . $i;
            $blogId = DB::table('blogs')->insertGetId([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non placerat dolor, eget lacinia ipsum. Donec posuere eu ante eu elementum. Ut eu porta leo, a ultricies urna.</p><p>Fusce auctor convallis ornare. Nunc eleifend elit ut justo convallis, quis laoreet mi maximus.</p>',
                'thumbnail_image' => 'The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg', // Using your sample image
                'publish_date' => Carbon::now()->subDays(rand(1, 60)),
                'author' => 'Brooke',
                'status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Attach Random Categories
            DB::table('blog_category_relations')->insert([
                'blog_id' => $blogId,
                'blog_category_id' => $catIds[array_rand($catIds)],
            ]);

            // 4. Add Slider Images
            DB::table('blog_images')->insert([
                ['blog_id' => $blogId, 'image_path' => 'Indiana-Everglades-Icon-and-Banner-for-Articles.jpg', 'created_at' => now()],
                ['blog_id' => $blogId, 'image_path' => 'Alternate-Blog-Banner.jpg', 'created_at' => now()],
            ]);
        }
    }
}