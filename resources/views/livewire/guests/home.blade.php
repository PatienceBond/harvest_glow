<div class="space-y-16">
    <!-- Hero Section -->
    <div id="home-hero">
        @if($heroSection)
            <x-ui.landing-hero
                heading="{{ $heroSection->heading }}"
                subheading="{{ $heroSection->subheading }}"
                :sliderImages="$heroSection->images->pluck('image_path')->map(fn($path) => Storage::url($path))->toArray()"
                height="{{ $heroSection->height }}"
            />
        @else
            <x-ui.landing-hero
                heading="Empowering Farmers, Building Futures"
                height="700px"
            />
        @endif
    </div>


<!-- Impact Section -->
    <section id="home-impact" class="py-18">
        <x-ui.container>
            <x-ui.section-header
                title="Our Impact (2025)"
            />

            <!-- Impact Cards Grid - Dynamic from Database -->
            @if($featuredMetrics && $featuredMetrics->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-8">
                    @foreach($featuredMetrics as $metric)
                        <x-ui.impact-card
                            value="{{ $metric->value }}{{ $metric->unit ? ' ' . $metric->unit : '' }}"
                            description="{{ $metric->description ?? $metric->title }}"
                        />
                    @endforeach
                </div>
            @else
                <!-- Fallback if no metrics in database -->
                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-2 mt-8">
                    <x-ui.impact-card
                        value="4,000+ people reached"
                        description="through sustainable agriculture, nutrition, and livelihoods programs"
                    />
                    <x-ui.impact-card
                        value="2000+ youths and children engaged"
                        description="in school feeding, agri-nutrition clubs, and awareness campaigns"
                    />
                    <x-ui.impact-card
                        value="1500+ young people trained"
                        description="in digital skills, agribusiness, and climate-smart farming practices"
                    />
                    <x-ui.impact-card
                        value="150+ entrepreneurs engaged"
                        description="in capacity-building, market linkages, and value chain development"
                    />
                    <x-ui.impact-card
                        value="200 hectares of basic seed produced"
                        description="to strengthen food security and boost farmer productivity"
                    />
                    <x-ui.impact-card
                        value="$30,000 mobilized in seed capital"
                        description="to support trainings, community enterprises, and farmer-led innovations"
                    />
                </div>
            @endif
        </x-ui.container>
    </section>

    <section id="home-model" class="py-18 bg-white">
        <x-ui.container>
            <div class="text-center mb-12">
                <a href="/our-model" class="inline-flex items-center bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary/90 transition-all shadow-md mx-auto mb-6">
                    Our Model
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    HarvestGlow transforms agriculture and strengthens communities through a smart, technology-driven model that integrates:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                <!-- Seed Access & Multiplication -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all text-center">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 mx-auto">
                        <img src="{{ asset('logo/icons/seed.png') }}" alt="Seed Access" class="w-6 h-6">
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Seed Access & Multiplication</h3>
                    <p class="text-muted-foreground text-sm">Empowering farmers with high-quality, locally adapted seeds. Building resilient, farmer-led seed systems through community-based Seed Villages.</p>
                </div>

                <!-- Financial & Gender Inclusion -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all text-center">
                    <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center mb-4 mx-auto">
                        <x-heroicon-o-users class="w-6 h-6 text-secondary" />
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Financial & Gender Inclusion</h3>
                    <p class="text-muted-foreground text-sm">Empowering all genders equally: respecting differences, embracing strengths, building inclusive spaces where everyone thrives together.</p>
                </div>

                <!-- Training & Capacity Building -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all text-center">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 mx-auto">
                        <x-heroicon-o-academic-cap class="w-6 h-6 text-primary" />
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Training & Capacity Building</h3>
                    <p class="text-muted-foreground text-sm">Hands-on skills in precision agriculture and AI-powered decision-making to maximize productivity.</p>
                </div>

                <!-- Village Savings & Loans -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all text-center">
                    <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center mb-4 mx-auto">
                        <x-heroicon-o-banknotes class="w-6 h-6 text-secondary" />
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Village Savings & Loans (VSLs)</h3>
                    <p class="text-muted-foreground text-sm">Empowering farmers with financial tools to invest in their farms.</p>
                </div>

                <!-- Processing & Value Addition -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all text-center">
                    <div class="w-12 h-12 rounded-full bg-success/10 flex items-center justify-center mb-4 mx-auto">
                        <x-heroicon-o-cog-6-tooth class="w-6 h-6 text-success" />
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Processing & Value Addition</h3>
                    <p class="text-muted-foreground text-sm">Enhancing local agro-processing to boost incomes and reduce post-harvest losses.</p>
                </div>
            </div>
        </x-ui.container>
    </section>

    <!-- Products Section -->
    <section id="home-products" class="py-18">
        <x-ui.container>
            <x-ui.section-header
                title="Our Products"
                description="Through our value-added processing initiatives, we help farmers transform raw crops into high-quality products. View more on our model page."
            />

            <!-- Products Grid (From Database) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <x-ui.product-card
                        title="{{ $product->title }}"
                        description="{{ $product->description }}"
                        image="{{ $product->image ? Storage::url($product->image) : null }}"
                    />
                @empty
                    <div class="col-span-full text-center py-8 text-muted-foreground">
                        <p>No products available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </x-ui.container>
    </section>

    <!-- Progress Section -->
    <section id="home-progress" class="py-4.5">
        <x-ui.container>
            <x-ui.section-header
                title="Progress Toward Our 2028 Goals"
                description="We're working to reach 600,000 farmers, achieve 50% certified seed adoption, and increase average household incomes by 40%."
            />

            <!-- Progress Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.progress-card
                    title="Farmers Reached"
                    :progress="17"
                    current="100,000"
                    goal="600,000"
                />

                <x-ui.progress-card
                    title="Certified Seed Adoption"
                    :progress="30"
                    current="15%"
                    goal="50%"
                />

                <x-ui.progress-card
                    title="Income Increase"
                    :progress="50"
                    current="20%"
                    goal="40%"
                />

                <x-ui.progress-card
                    title="Women Participation"
                    :progress="40"
                    current="20%"
                    goal="50%"
                />
            </div>
        </x-ui.container>
    </section>

    <!-- News Section -->
    <section id="news">
        <x-ui.container>
            <x-ui.section-header
                title="News"
                description="Stay informed about our latest activities, success stories, and impact in communities across Malawi."
            />

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($latestPosts as $post)
                    <x-ui.news-card
                        :title="$post->title"
                        :excerpt="$post->excerpt"
                        :date="$post->published_at ? $post->published_at->format('F j, Y') : $post->created_at->format('F j, Y')"
                        :image="$post->featured_image ? Storage::url($post->featured_image) : asset('images/hero/hero1.webp')"
                        :link="route('news-details', ['slug' => $post->slug])"
                    />
                @empty
                    <div class="col-span-full text-center py-12">
                        <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-muted-foreground" />
                        <h3 class="mt-2 text-sm font-medium text-foreground">No posts available</h3>
                        <p class="mt-1 text-sm text-muted-foreground">
                            Check back later for the latest news and updates.
                        </p>
                    </div>
                @endforelse
            </div>
        </x-ui.container>
    </section>

    <!-- Partners Section -->
    <section class="py-4.5">
        <x-ui.container>
            <x-ui.section-header
                title="Our Partners"
                description="We collaborate with organizations that share our vision for sustainable agriculture and rural development."
            />

            <!-- Partners Logos -->
            <div class="flex flex-wrap justify-center items-center gap-4 mb-8">
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/mastercard.png') }}" alt="Mastercard Foundation" class="h-full w-auto object-contain ">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/Woman research award.png') }}" alt="AWARD - African Women in Agricultural Research and Development" class="h-full w-auto object-contain ">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/anzisha prize.png') }}" alt="Anzisha Prize" class="h-full w-auto object-contain ">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/ala.png') }}" alt="African Leadership Academy" class="h-full w-auto object-contain ">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/university_of_pretoria.png') }}" alt="University of Pretoria" class="h-full w-auto object-contain ">
                </div>
            </div>

        
        </x-ui.container>
    </section>
    <script>
        (function(){
            function toggleOnlyNews(){
                var onlyNews = window.location.hash === '#news';
                var ids = ['home-hero','home-impact','home-model','home-products','home-progress'];
                ids.forEach(function(id){
                    var el = document.getElementById(id);
                    if(el){ el.style.display = onlyNews ? 'none' : ''; }
                });
            }
            window.addEventListener('hashchange', toggleOnlyNews);
            document.addEventListener('DOMContentLoaded', toggleOnlyNews);
        })();
    </script>
</div>

