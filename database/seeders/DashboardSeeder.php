<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\ImpactMetric;
use App\Models\User;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            [
                'name' => 'Impact',
                'slug' => 'impact',
                'description' => 'Stories about our impact and achievements',
                'color' => '#059669',
            ],
            [
                'name' => 'Community',
                'slug' => 'community',
                'description' => 'Community development and engagement',
                'color' => '#3b82f6',
            ],
            [
                'name' => 'Training',
                'slug' => 'training',
                'description' => 'Educational programs and training initiatives',
                'color' => '#8b5cf6',
            ],
            [
                'name' => 'Economic Development',
                'slug' => 'economic-development',
                'description' => 'Economic empowerment and development programs',
                'color' => '#f59e0b',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // Create impact metrics
        $metrics = [
            [
                'title' => 'Farmers Reached',
                'value' => '1,000+',
                'unit' => 'farmers',
                'description' => 'Smallholder farmers provided with access to certified seeds, training, and credit facilities.',
                'icon' => '🌾',
                'color' => '#059669',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Communities Served',
                'value' => '500+',
                'unit' => 'communities',
                'description' => 'Rural communities receiving agricultural support and annual medical outreach services.',
                'icon' => '🏘️',
                'color' => '#3b82f6',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Metric Tons Produced',
                'value' => '10,855+',
                'unit' => 'metric tons',
                'description' => 'Increased crop production through certified seed access and improved farming techniques.',
                'icon' => '📈',
                'color' => '#8b5cf6',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Income Increase',
                'value' => '40%',
                'unit' => 'average',
                'description' => 'Average household income growth for participating farmers through improved yields and value addition.',
                'icon' => '💰',
                'color' => '#f59e0b',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Youth Trained',
                'value' => '500+',
                'unit' => 'youth',
                'description' => 'Young people trained in climate-smart agricultural techniques.',
                'icon' => '👥',
                'color' => '#ef4444',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'VSL Groups',
                'value' => '25',
                'unit' => 'groups',
                'description' => 'Village Savings and Loans groups established for financial inclusion.',
                'icon' => '🏦',
                'color' => '#10b981',
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($metrics as $metricData) {
            ImpactMetric::firstOrCreate(
                ['title' => $metricData['title']],
                $metricData
            );
        }

        // Create sample posts if user exists
        $user = User::first();
        if ($user) {
            $impactCategory = Category::where('slug', 'impact')->first();
            $communityCategory = Category::where('slug', 'community')->first();

            $posts = [
                [
                    'title' => 'Empowering Farmers Through Seed Multiplication',
                    'slug' => 'empowering-farmers-seed-multiplication',
                    'excerpt' => 'Our Seed Villages program has helped over 1,000 farmers gain access to certified seeds, increasing crop yields by 40%.',
                    'content' => "HarvestGlow continues to make significant strides in transforming agricultural practices across Malawi. Our integrated approach combines seed access, village savings groups, value-added processing, and climate-smart training to create sustainable change in rural communities.\n\nThrough our Seed Villages program, we've successfully established farmer-led multiplication initiatives that have increased crop yields by an average of 40% among participating farmers. This program not only improves food security but also creates new economic opportunities for rural households.\n\n## Key Achievements\n\n- Over 1,000 farmers gained access to certified seeds\n- 40% increase in average crop yields\n- 15 new processing units established\n- 500+ youth trained in climate-smart techniques\n- $30,000 mobilized in community savings\n\nOur Village Savings and Loans (VSL) groups have been particularly successful in building financial resilience among rural communities. These groups have not only provided access to credit but have also fostered a culture of savings and collective investment in agricultural improvements.",
                    'featured_image' => asset('images/hero/hero1.webp'),
                    'is_published' => true,
                    'published_at' => now()->subDays(5),
                    'user_id' => $user->id,
                    'category_id' => $impactCategory?->id,
                ],
                [
                    'title' => 'Women-Led Savings Groups Transform Communities',
                    'slug' => 'women-led-savings-groups-transform-communities',
                    'excerpt' => 'Village savings groups have mobilized over $30,000 in community capital, supporting local enterprises and farmer innovations.',
                    'content' => "The power of collective action is evident in our Village Savings and Loans (VSL) groups, where women have taken the lead in transforming their communities through financial inclusion and economic empowerment.\n\nThese groups have not only provided access to credit but have also fostered a culture of savings and collective investment in agricultural improvements. The results speak for themselves:\n\n- Over $30,000 mobilized in community capital\n- 25 active VSL groups across multiple districts\n- 80% of members are women\n- Average savings per member increased by 300%\n\n## Success Stories\n\nMary Banda from Kasungu district shared: 'The savings group has given me the confidence to invest in my farm. I was able to buy better seeds and now my harvest has doubled.'\n\nThese groups demonstrate how financial inclusion can drive agricultural transformation and community development.",
                    'featured_image' => asset('images/hero/hero1.webp'),
                    'is_published' => true,
                    'published_at' => now()->subDays(10),
                    'user_id' => $user->id,
                    'category_id' => $communityCategory?->id,
                ],
                [
                    'title' => 'Climate-Smart Training Reaches 500 Youth',
                    'slug' => 'climate-smart-training-reaches-500-youth',
                    'excerpt' => 'Young farmers learn conservation agriculture techniques to build resilience against climate change impacts.',
                    'content' => "Climate change poses significant challenges to agricultural productivity in Malawi. To address this, HarvestGlow has implemented comprehensive climate-smart training programs targeting young farmers.\n\nOur training covers:\n\n- Conservation agriculture techniques\n- Water management strategies\n- Drought-resistant crop varieties\n- Soil conservation methods\n- Climate adaptation planning\n\n## Impact Results\n\n- 500+ youth trained across 15 districts\n- 85% reported improved crop resilience\n- 60% reduction in crop losses during dry seasons\n- 40% increase in water use efficiency\n\nThe program has been particularly successful in empowering young farmers to become climate champions in their communities, sharing knowledge and techniques with their peers and families.",
                    'featured_image' => asset('images/hero/hero1.webp'),
                    'is_published' => true,
                    'published_at' => now()->subDays(15),
                    'user_id' => $user->id,
                    'category_id' => Category::where('slug', 'training')->first()?->id,
                ],
            ];

            foreach ($posts as $postData) {
                Post::firstOrCreate(
                    ['slug' => $postData['slug']],
                    $postData
                );
            }
        }
    }
}