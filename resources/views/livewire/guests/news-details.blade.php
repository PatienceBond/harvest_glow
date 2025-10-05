<div>
    <!-- Hero Section -->
    <x-ui.hero
        image="{{ asset('images/hero/hero1.webp') }}"
        heading="{{ $newsItem['title'] ?? 'Latest News' }}"
        subheading="Stay informed about our latest activities and impact in communities across Malawi."
        height="400px"
        class="text-white"
    />

    <x-ui.vstack>
        <!-- News Article Section -->
        <section>
            <x-ui.container>
                <div class="max-w-4xl mx-auto">
                    <!-- Article Meta -->
                    <div class="mb-8">
                        <div class="flex items-center gap-4 text-sm text-muted-foreground mb-4">
                            <span>{{ $newsItem['date'] ?? 'January 15, 2025' }}</span>
                            <span>•</span>
                            <span>{{ $newsItem['category'] ?? 'Impact' }}</span>
                            <span>•</span>
                            <span>5 min read</span>
                        </div>
                        
                        <!-- Article Image -->
                        <div class="mb-8">
                            <img 
                                src="{{ $newsItem['image'] ?? asset('images/hero/hero1.webp') }}" 
                                alt="{{ $newsItem['title'] ?? 'News Article' }}"
                                class="w-full h-96 object-cover rounded-lg"
                            >
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        <div class="text-xl text-muted-foreground mb-8 leading-relaxed">
                            {{ $newsItem['excerpt'] ?? 'This is a sample news article excerpt that provides a brief overview of the content and encourages readers to continue reading the full article.' }}
                        </div>

                        <div class="space-y-6 text-lg leading-relaxed">
                            <p>
                                HarvestGlow continues to make significant strides in transforming agricultural practices across Malawi. Our integrated approach combines seed access, village savings groups, value-added processing, and climate-smart training to create sustainable change in rural communities.
                            </p>

                            <p>
                                Through our Seed Villages program, we've successfully established farmer-led multiplication initiatives that have increased crop yields by an average of 40% among participating farmers. This program not only improves food security but also creates new economic opportunities for rural households.
                            </p>

                            <h2 class="text-2xl font-bold mt-8 mb-4">Key Achievements</h2>
                            
                            <ul class="list-disc pl-6 space-y-2">
                                <li>Over 1,000 farmers gained access to certified seeds</li>
                                <li>40% increase in average crop yields</li>
                                <li>15 new processing units established</li>
                                <li>500+ youth trained in climate-smart techniques</li>
                                <li>$30,000 mobilized in community savings</li>
                            </ul>

                            <p>
                                Our Village Savings and Loans (VSL) groups have been particularly successful in building financial resilience among rural communities. These groups have not only provided access to credit but have also fostered a culture of savings and collective investment in agricultural improvements.
                            </p>

                            <blockquote class="border-l-4 border-primary pl-6 italic text-xl my-8">
                                "The support from HarvestGlow has transformed our community. We now have access to better seeds, processing equipment, and the knowledge to grow more food for our families and generate income."
                                <footer class="text-base font-medium mt-2">— Mary Banda, Farmer from Kasungu</footer>
                            </blockquote>

                            <h2 class="text-2xl font-bold mt-8 mb-4">Looking Ahead</h2>
                            
                            <p>
                                As we move forward, HarvestGlow remains committed to expanding our reach and deepening our impact. Our 2028 goals include reaching 10,000 farmers, achieving 50% certified seed adoption, and increasing average household incomes by 40%.
                            </p>

                            <p>
                                We're also excited about new partnerships and initiatives that will further strengthen our ability to support rural communities in Malawi. These include expanded training programs, new processing technologies, and enhanced market linkages.
                            </p>
                        </div>
                    </div>

                    <!-- Article Footer -->
                    <div class="mt-12 pt-8 border-t border-border">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                    <x-heroicon-o-user class="w-6 h-6 text-primary" />
                                </div>
                                <div>
                                    <div class="font-medium">HarvestGlow Team</div>
                                    <div class="text-sm text-muted-foreground">Published by HarvestGlow</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <button class="p-2 hover:bg-muted rounded-lg transition-colors" title="Share">
                                    <x-heroicon-o-share class="w-5 h-5" />
                                </button>
                                <button class="p-2 hover:bg-muted rounded-lg transition-colors" title="Bookmark">
                                    <x-heroicon-o-bookmark class="w-5 h-5" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.container>
        </section>

        <!-- Related News Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Related News"
                    description="Stay updated with our latest activities and impact stories."
                />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-ui.news-card
                        title="Women-Led Savings Groups Transform Communities"
                        excerpt="Village savings groups have mobilized over $30,000 in community capital, supporting local enterprises and farmer innovations."
                        date="January 10, 2025"
                        image="{{ asset('images/hero/hero1.webp') }}"
                        link="{{ route('news-details', ['slug' => 'women-led-savings-groups']) }}"
                    />

                    <x-ui.news-card
                        title="Climate-Smart Training Reaches 500 Youth"
                        excerpt="Young farmers learn conservation agriculture techniques to build resilience against climate change impacts."
                        date="January 5, 2025"
                        image="{{ asset('images/hero/hero1.webp') }}"
                        link="{{ route('news-details', ['slug' => 'climate-smart-training-youth']) }}"
                    />

                    <x-ui.news-card
                        title="New Processing Units Boost Local Economy"
                        excerpt="Community processing units have created jobs and increased local income by $8,000 in the first year."
                        date="December 28, 2024"
                        image="{{ asset('images/hero/hero1.webp') }}"
                        link="{{ route('news-details', ['slug' => 'processing-units-boost-economy']) }}"
                    />
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
