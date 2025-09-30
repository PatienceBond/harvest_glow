<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\ImpactMetric;
use Illuminate\Database\Seeder;

class HarvestGlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'HarvestGlow Admin',
            'email' => 'admin@harvestglow.org',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Create categories
        $categories = [
            ['name' => 'Impact Stories', 'slug' => 'impact-stories', 'description' => 'Success stories from our farming communities', 'color' => '#388E3C'],
            ['name' => 'Programs', 'slug' => 'programs', 'description' => 'Our agricultural programs and initiatives', 'color' => '#FFD700'],
            ['name' => 'Innovation', 'slug' => 'innovation', 'description' => 'Latest innovations in sustainable agriculture', 'color' => '#FFA000'],
            ['name' => 'Partnerships', 'slug' => 'partnerships', 'description' => 'Collaborations and partnerships', 'color' => '#2E7D32'],
            ['name' => 'News', 'slug' => 'news', 'description' => 'Latest news and updates', 'color' => '#4CAF50'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create impact metrics
        $metrics = [
            [
                'title' => 'Farmers Reached',
                'value' => '15,000',
                'unit' => 'farmers',
                'description' => 'Smallholder farmers directly supported',
                'icon' => 'users',
                'color' => '#388E3C',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Income Increase',
                'value' => '45',
                'unit' => '%',
                'description' => 'Average income increase for participating farmers',
                'icon' => 'trending-up',
                'color' => '#FFD700',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Women Participation',
                'value' => '65',
                'unit' => '%',
                'description' => 'Women participation in our programs',
                'icon' => 'heart',
                'color' => '#FFA000',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Hectares Improved',
                'value' => '25,000',
                'unit' => 'hectares',
                'description' => 'Agricultural land improved through our programs',
                'icon' => 'leaf',
                'color' => '#2E7D32',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($metrics as $metric) {
            ImpactMetric::create($metric);
        }

        // Create sample posts
        Post::factory(20)->create();
    }
}
