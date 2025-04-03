<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        // Create categories
        $categories = [
            'Technology',
            'Travel',
            'Food',
            'Health',
            'Lifestyle'
        ];

        $categoryIds = [];
        foreach ($categories as $categoryName) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName)
            ]);
            $categoryIds[] = $category->id;
        }

        // Create sample posts
        for ($i = 1; $i <= 10; $i++) {
            $title = "Sample Blog Post $i";
            $post = Post::create([
                'user_id' => $admin->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => "<p>This is a sample blog post content for post $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>",
                'is_published' => true,
                'created_at' => now()->subDays(rand(1, 30)),
            ]);

            // Attach random categories (1-3) to each post
            $randomCategoryCount = rand(1, 3);
            $randomCategoryIds = array_rand(array_flip($categoryIds), $randomCategoryCount);
            if (!is_array($randomCategoryIds)) {
                $randomCategoryIds = [$randomCategoryIds];
            }
            $post->categories()->attach($randomCategoryIds);
        }
    }
}
