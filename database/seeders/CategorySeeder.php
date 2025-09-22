<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Latest technology trends and innovations',
                'slug' => 'technology',
                'is_active' => true,
            ],
            [
                'name' => 'Business',
                'description' => 'Business news and insights',
                'slug' => 'business',
                'is_active' => true,
            ],
            [
                'name' => 'Lifestyle',
                'description' => 'Lifestyle and wellness content',
                'slug' => 'lifestyle',
                'is_active' => true,
            ],
            [
                'name' => 'Entertainment',
                'description' => 'Entertainment and celebrity news',
                'slug' => 'entertainment',
                'is_active' => true,
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports news and updates',
                'slug' => 'sports',
                'is_active' => true,
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
