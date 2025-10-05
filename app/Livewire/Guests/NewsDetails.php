<?php

namespace App\Livewire\Guests;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class NewsDetails extends Component
{
    public $slug;
    public $newsItem;

    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        // Sample news data - in a real app, this would come from a database
        $this->newsItem = $this->getNewsItem($slug);
    }

    private function getNewsItem($slug)
    {
        // Sample news items - in a real app, this would be fetched from database
        $newsItems = [
            'empowering-farmers-seed-multiplication' => [
                'title' => 'Empowering Farmers Through Seed Multiplication',
                'excerpt' => 'Our Seed Villages program has helped over 1,000 farmers gain access to certified seeds, increasing crop yields by 40%.',
                'date' => 'January 15, 2025',
                'category' => 'Impact',
                'image' => asset('images/hero/hero1.webp')
            ],
            'women-led-savings-groups' => [
                'title' => 'Women-Led Savings Groups Transform Communities',
                'excerpt' => 'Village savings groups have mobilized over $30,000 in community capital, supporting local enterprises and farmer innovations.',
                'date' => 'January 10, 2025',
                'category' => 'Community',
                'image' => asset('images/hero/hero1.webp')
            ],
            'climate-smart-training-youth' => [
                'title' => 'Climate-Smart Training Reaches 500 Youth',
                'excerpt' => 'Young farmers learn conservation agriculture techniques to build resilience against climate change impacts.',
                'date' => 'January 5, 2025',
                'category' => 'Training',
                'image' => asset('images/hero/hero1.webp')
            ],
            'processing-units-boost-economy' => [
                'title' => 'New Processing Units Boost Local Economy',
                'excerpt' => 'Community processing units have created jobs and increased local income by $8,000 in the first year.',
                'date' => 'December 28, 2024',
                'category' => 'Economic Development',
                'image' => asset('images/hero/hero1.webp')
            ]
        ];

        return $newsItems[$slug] ?? [
            'title' => 'Latest News from HarvestGlow',
            'excerpt' => 'Stay updated with our latest activities and impact stories from communities across Malawi.',
            'date' => 'January 15, 2025',
            'category' => 'News',
            'image' => asset('images/hero/hero1.webp')
        ];
    }

    public function render()
    {
        return view('livewire.guests.news-details');
    }
}
