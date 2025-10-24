@if($post)
<div>
    <!-- Hero Section -->
    <x-ui.hero
        image="{{ asset('images/hero/soya.jpg') }}"
        heading="stay informed"
        height="300px"
        align="center"
        headingClass="text-3xl md:text-4xl font-bold"
        contentPaddingClass="py-16"
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
                            <span>{{ $post->published_at ? $post->published_at->format('F j, Y') : $post->created_at->format('F j, Y') }}</span>
                            @if($post->category)
                            <span>•</span>
                            <span>{{ $post->category->name }}</span>
                            @endif
                            <span>•</span>
                            <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                        </div>
                        
                        <!-- Article Image -->
                        @if($post->featured_image)
                        <div class="mb-8">
                            <img 
                                src="{{ Storage::url($post->featured_image) }}" 
                                alt="{{ $post->title }}"
                                class="w-full h-96 object-cover rounded-lg"
                            >
                        </div>
                        @endif
                    </div>

                    <!-- Article Title -->
                    <h1 class="text-4xl font-bold text-foreground mb-6">{{ $post->title }}</h1>

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        @if($post->excerpt)
                        <div class="text-xl text-muted-foreground mb-8 leading-relaxed">
                            {{ $post->excerpt }}
                        </div>
                        @endif

                        <div class="space-y-6 text-lg leading-relaxed">
                            {!! $post->content !!}
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
                    @forelse($relatedPosts as $relatedPost)
                        <x-ui.news-card
                            :title="$relatedPost->title"
                            :excerpt="$relatedPost->excerpt"
                            :date="$relatedPost->published_at ? $relatedPost->published_at->format('F j, Y') : $relatedPost->created_at->format('F j, Y')"
                            :image="$relatedPost->featured_image ? Storage::url($relatedPost->featured_image) : asset('images/hero/hero1.webp')"
                            :link="route('news-details', ['slug' => $relatedPost->slug])"
                        />
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-muted-foreground">No related posts available.</p>
                        </div>
                    @endforelse
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
@else
<div>
    <x-ui.container>
        <div class="text-center py-12">
            <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-muted-foreground" />
            <h3 class="mt-2 text-sm font-medium text-foreground">Post not found</h3>
            <p class="mt-1 text-sm text-muted-foreground">
                The post you're looking for doesn't exist or has been removed.
            </p>
            <div class="mt-6">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <x-heroicon-o-arrow-left class="w-4 h-4 mr-2" />
                    Back to Home
                </a>
            </div>
        </div>
    </x-ui.container>
</div>
@endif
