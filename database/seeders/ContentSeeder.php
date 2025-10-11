<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Partner;
use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Products
        Product::create([
            'title' => 'Peanut Butter',
            'description' => 'Locally produced, nutritious peanut butter made from high-quality groundnuts grown by our farmer network.',
            'order' => 1,
            'is_active' => true,
        ]);

        Product::create([
            'title' => 'Soy Milk',
            'description' => 'Plant-based milk alternative rich in protein and essential nutrients, supporting dietary diversity.',
            'order' => 2,
            'is_active' => true,
        ]);

        Product::create([
            'title' => 'Cooking Oil',
            'description' => 'Pure, cold-pressed cooking oil produced from locally grown oilseeds, providing a healthy cooking option.',
            'order' => 3,
            'is_active' => true,
        ]);

        Product::create([
            'title' => 'Soy Cake',
            'description' => 'Protein-rich animal feed byproduct from soy processing, enhancing livestock nutrition.',
            'order' => 4,
            'is_active' => true,
        ]);

        Product::create([
            'title' => 'Plant-Based Juices',
            'description' => 'Traditional and nutritious juices made from local plants, promoting health and wellness.',
            'order' => 5,
            'is_active' => true,
        ]);

        // Strategic Partners
        Partner::create([
            'name' => 'MasterCard Foundation',
            'description' => 'The Mastercard Foundation works with visionary organizations to enable young people in Africa and in Indigenous communities in Canada to access dignified and fulfilling work.',
            'website' => 'https://mastercardfdn.org',
            'category' => 'Strategic Partner',
            'order' => 1,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'AWARD',
            'description' => 'African Women in Agricultural Research and Development (AWARD) works toward inclusive, agriculture-driven prosperity for Africa.',
            'website' => 'https://awardfellowships.org',
            'category' => 'Strategic Partner',
            'order' => 2,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Anzisha Prize',
            'description' => 'The Anzisha Prize is Africa\'s biggest award for young entrepreneurs aged 15-22 and is a partnership between African Leadership Academy and Mastercard Foundation.',
            'website' => 'https://anzishaprize.org',
            'category' => 'Strategic Partner',
            'order' => 3,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'African Leadership Academy',
            'description' => 'African Leadership Academy seeks to transform Africa by developing a powerful network of young leaders.',
            'website' => 'https://africanleadershipacademy.org',
            'category' => 'Strategic Partner',
            'order' => 4,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Talloires Network',
            'description' => 'The Talloires Network is an international association of institutions committed to strengthening the civic roles and social responsibilities of higher education.',
            'website' => 'https://talloiresnetwork.tufts.edu',
            'category' => 'Strategic Partner',
            'order' => 5,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'University of Pretoria',
            'description' => 'The University of Pretoria is one of Africa\'s top universities with a focus on research and agricultural innovation.',
            'website' => 'https://www.up.ac.za',
            'category' => 'Strategic Partner',
            'order' => 6,
            'is_active' => true,
        ]);

        // Research Partner
        Partner::create([
            'name' => 'Department of Agricultural Research',
            'description' => 'Malawi\'s Department of Agricultural Research conducts research on crops, livestock, and natural resources to improve agricultural productivity.',
            'website' => 'https://www.malawi.gov.mw',
            'category' => 'Research Partner',
            'order' => 1,
            'is_active' => true,
        ]);

        // Implementation Partners
        Partner::create([
            'name' => 'Local Government Authorities',
            'description' => 'We work closely with district councils and local government authorities to ensure our programs align with local development priorities.',
            'category' => 'Implementation Partner',
            'order' => 1,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Farmer Cooperatives',
            'description' => 'We partner with local farmer cooperatives to implement our programs and ensure community ownership and sustainability.',
            'category' => 'Implementation Partner',
            'order' => 2,
            'is_active' => true,
        ]);

        // Hero Sections
        HeroSection::create([
            'page' => 'home',
            'heading' => 'Empowering Farmers, Building Futures',
            'subheading' => 'Transforming agriculture through sustainable practices and community-driven solutions',
            'height' => '700px',
            'is_active' => true,
        ]);

        HeroSection::create([
            'page' => 'partners',
            'heading' => 'Our Partners',
            'subheading' => 'Collaborating with organizations that share our vision for sustainable agriculture and rural development',
            'height' => '500px',
            'is_active' => true,
        ]);

        HeroSection::create([
            'page' => 'contact',
            'heading' => 'Contact Us',
            'subheading' => 'Get in touch with our team to learn more about our work or explore collaboration opportunities',
            'height' => '500px',
            'is_active' => true,
        ]);

        HeroSection::create([
            'page' => 'about',
            'heading' => 'About HarvestGlow',
            'subheading' => 'Empowering farmers and communities through sustainable agriculture',
            'height' => '500px',
            'is_active' => true,
        ]);
    }
}

