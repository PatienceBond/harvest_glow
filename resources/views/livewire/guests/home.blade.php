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

    <!-- AI-Powered Agricultural Innovation -->
    <section id="ai-innovation" class="py-4.5 bg-white relative">
        <style>
            .ai-card {
                position: relative;
                z-index: 20; /* Increased z-index for cards */
                transition: all 0.3s ease;
                background: white; /* Ensure cards have solid background */
                box-shadow: 0 4px 6px -1px rgba(154, 199, 171, 0.3), 0 2px 4px -1px rgba(154, 199, 171, 0.2);
            }
            
            .ai-card:hover {
                transform: scale(0.98) translateY(-3px);
                box-shadow: 0 6px 8px -1px rgba(154, 199, 171, 0.4), 0 4px 6px -1px rgba(154, 199, 171, 0.3);
            }
            
            .icon-bg {
                background-color: #f9fafb !important;
            }
            
            /* Connection lines */
            .connection-lines {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 0;
            }
            
            .connection-line {
                position: absolute;
                background: #3b82f6;
                height: 2px;
                transform-origin: left center;
                z-index: 0;
                opacity: 0;
                animation: drawLine 0.5s forwards;
            }
            
            .connection-line::after {
                content: '';
                position: absolute;
                right: -5px;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 0;
                border-top: 5px solid transparent;
                border-bottom: 5px solid transparent;
                border-left: 8px solid #527f63; /* Updated to green color */
            }
            
            @keyframes drawLine {
                from { width: 0; opacity: 0; }
                to { width: var(--line-length); opacity: 0.6; }
            }
            
            /* Connection lines container */
            .connection-lines {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                pointer-events: none;
                z-index: 5; /* Lower than cards */
                overflow: visible;
            }
            
            /* Individual line styling */
            .connection-line {
                position: absolute;
                background: #527f63; /* Updated to green color */
                height: 2px;
                transform-origin: left center;
                z-index: 5; /* Lower than cards */
                opacity: 0.6; /* Slightly more transparent */
                overflow: visible;
                pointer-events: none;
                will-change: transform, opacity;
            }
            
            .connection-line::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 40px;
                height: 100%;
                background: linear-gradient(90deg, 
                    transparent, 
                    rgba(255, 255, 255, 0.9),
                    rgba(255, 255, 255, 0.7),
                    transparent);
                animation: flow 2s linear infinite;
                transform: translateX(-100%);
                opacity: 0.8;
            }
            
            @keyframes flow {
                0% { 
                    transform: translateX(-100%) scaleX(1);
                    opacity: 0.8;
                }
                50% {
                    opacity: 1;
                }
                100% { 
                    transform: translateX(calc(100% + var(--line-length))) scaleX(1.5);
                    opacity: 0.8;
                }
            }
            
            /* Arrow head */
            .connection-line::after {
                content: '';
                position: absolute;
                right: -5px;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 0;
                border-top: 5px solid transparent;
                border-bottom: 5px solid transparent;
                border-left: 8px solid #527f63; /* Updated to green color */
            }
            
            /* Hide on mobile */
            @media (max-width: 768px) {
                .connection-lines, .connection-line {
                    display: none;
                }
            }
        </style>
        <x-ui.container>
            <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <img src="{{ asset('logo/logo_icon.png') }}" alt="Logo" class="h-8 w-auto">
                    <h1 class="text-4xl font-bold">AI-Powered Agricultural Innovation</h1>
                </div>
                <p class="text-lg text-muted-foreground max-w-3xl mx-auto">Empowering Farmers Through Data, Technology & Local Value Creation</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <!-- Smart Seed Systems -->
                <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-1" style="min-height: 280px;">
                    <div class="p-3 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                            <img src="{{ asset('logo/icons/sprout.png') }}" alt="Smart Seed Systems" class="w-8 h-8 object-contain">
                        </div>
                        <h3 class="text-xlg font-bold text-center mb-2">Smart Seed Systems</h3>
                        <p class="text-muted-foreground text-center mb-3 text-base">Predictive analytics for drought & pest resistance</p>
                        <div class="mt-auto">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                                <p class="text-sm font-medium">Reliable access to quality, climate-resilient seeds</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial & Gender Inclusion | Smart Lending -->
                <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-2" style="min-height: 280px;">
                    <div class="p-3 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                            <img src="{{ asset('logo/icons/financial-inclusion.png') }}" alt="Financial & Gender Inclusion" class="w-8 h-8 object-contain">
                        </div>
                        <h3 class="text-xlg font-bold text-center mb-2">Financial & Gender Inclusion</h3>
                        <p class="text-muted-foreground text-center mb-3 text-base">Access to finance through AI-driven credit scoring from cooperative and yield data</p>
                        <div class="mt-auto">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                                <p class="text-sm font-medium">Inclusive finance for women and smallholders.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Value Addition & Processing -->
                <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-3" style="min-height: 280px;">
                    <div class="p-3 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                            <img src="{{ asset('logo/icons/supply-chain.png') }}" alt="Value Addition" class="w-8 h-8 object-contain">
                        </div>
                        <h3 class="text-xlg font-bold text-center mb-2">Value Addition & Processing</h3>
                        <p class="text-muted-foreground text-center mb-3 text-base">AI quality monitoring via imaging & sensors</p>
                        <div class="mt-auto">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                                <p class="text-sm font-medium">Increased incomes, reduced post-harvest loss</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Digital Climate Intelligence -->
                <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" style="min-height: 240px;">
                    <div class="p-3 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center shadow-md mx-auto mb-3 overflow-hidden">
                            <img src="{{ asset('logo/dzuwa.png') }}" alt="Climate Intelligence" class="w-10 h-10 object-contain">
                        </div>
                        <h3 class="text-xlg font-bold text-center mb-2">Digital Climate Intelligence</h3>
                        <p class="text-muted-foreground text-center mb-3 text-base">Satellite data, IoT & ML for advisory</p>
                        <div class="mt-auto">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                                <p class="text-sm font-medium">Resilient farms and adaptive practices</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technology-based -->
                <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border-2 border-blue-500 h-full flex flex-col relative z-10 w-80" id="tech-hub" style="min-height: 240px;">
                    <div class="p-3 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                            <img src="{{ asset('logo/icons/machine-learning.png') }}" alt="Technology Hub" class="w-8 h-8 object-contain">
                        </div>
                        <h3 class="text-xlg font-bold text-center mb-2">Technology-based</h3>
                        <p class="text-muted-foreground text-center mb-2 text-xs">Center of our innovation ecosystem</p>
                        <div class="mt-2 overflow-hidden rounded-lg">
                            <img src="{{ asset('images/drone technology.jpg') }}" 
                                 alt="Drone technology in agriculture" 
                                 class="w-full h-24 object-cover rounded-lg hover:scale-105 transition-transform duration-300">
                        </div>
                    </div>
                </div>

                <!-- Supporting Technologies -->
                <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-6" style="min-height: 240px;">
                    <div class="p-3 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                            <img src="{{ asset('logo/icons/iot.png') }}" alt="Supporting Technologies" class="w-8 h-8 object-contain">
                        </div>
                        <h3 class="text-xlg font-bold text-center mb-2">Supporting Technologies</h3>
                        <p class="text-muted-foreground text-center mb-3 text-base">Powering our digital transformation</p>
                        <div class="grid grid-cols-2 gap-1.5 mt-2">
                            <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                                <img src="{{ asset('logo/icons/smartphone.png') }}" alt="IoT" class="w-5 h-5">
                                <span class="text-xs font-medium">IoT Sensors</span>
                            </div>
                            <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                                <img src="{{ asset('logo/icons/drone.png') }}" alt="Drone" class="w-5 h-5">
                                <span class="text-xs font-medium">Drone Imaging</span>
                            </div>
                            <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                                <img src="{{ asset('logo/icons/camera-drone.png') }}" alt="Satellite" class="w-5 h-5">
                                <span class="text-xs font-medium">Satellite Data</span>
                            </div>
                            <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                                <img src="{{ asset('logo/icons/deep-learning.png') }}" alt="ML" class="w-5 h-5">
                                <span class="text-xs font-medium">ML Models</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Connection lines container (positioned absolutely within the section) -->
            <div class="connection-lines"></div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const connectionLines = document.querySelector('.connection-lines');
                if (!connectionLines) return;
                
                // Define connections: [fromId, toId]
                const connections = [
                    ['card-1', 'card-4'],     // Smart Seed Systems → Digital Climate Intelligence
                    ['card-4', 'tech-hub'],   // Digital Climate Intelligence → Technology-based
                    ['card-3', 'card-6'],     // Value Addition → Supporting Technologies
                    ['card-6', 'tech-hub'],   // Supporting Technologies → Technology-based
                    ['card-2', 'tech-hub']    // Financial Inclusion → Technology-based
                ];
                
                function updateLinePositions() {
                    if (!connectionLines) return;
                    
                    // Clear existing lines
                    connectionLines.innerHTML = '';
                    
                    // Get current scroll position
                    const scrollX = window.pageXOffset || document.documentElement.scrollLeft;
                    const scrollY = window.pageYOffset || document.documentElement.scrollTop;
                    
                    // Get the section's position
                    const section = document.getElementById('ai-innovation');
                    if (!section) return;
                    
                    connections.forEach(([fromId, toId], index) => {
                        const fromEl = document.getElementById(fromId);
                        const toEl = document.getElementById(toId);
                        
                        if (!fromEl || !toEl) return;
                        
                        // Get positions relative to the viewport
                        const fromRect = fromEl.getBoundingClientRect();
                        const toRect = toEl.getBoundingClientRect();
                        
                        // Calculate center points with scroll position
                        const fromCenter = {
                            x: fromRect.left + fromRect.width / 2,
                            y: fromRect.top + fromRect.height / 2
                        };
                        
                        const toCenter = {
                            x: toRect.left + toRect.width / 2,
                            y: toRect.top + toRect.height / 2
                        };
                        
                        // Calculate distance and angle
                        const dx = toCenter.x - fromCenter.x;
                        const dy = toCenter.y - fromCenter.y;
                        const length = Math.sqrt(dx * dx + dy * dy);
                        const angle = Math.atan2(dy, dx) * (180 / Math.PI);
                        
                        // Create line element
                        const line = document.createElement('div');
                        line.className = 'connection-line';
                        line.style.setProperty('--line-length', `${length}px`);
                        line.style.width = `${length}px`;
                        line.style.left = `${fromCenter.x}px`;
                        line.style.top = `${fromCenter.y}px`;
                        line.style.transform = `rotate(${angle}deg)`;
                        line.style.animationDelay = `${index * 0.1}s`;
                        
                        // Add arrow head only for the last segment to each destination
                        if (toId === 'tech-hub' || toId === 'card-4' || toId === 'card-6') {
                            line.style.overflow = 'visible';
                        }
                        
                        connectionLines.appendChild(line);
                    });
                }
                
                // Initial draw with multiple checks to ensure everything is loaded
                const init = () => {
                    // First try immediately
                    updateLinePositions();
                    
                    // Then after a short delay
                    setTimeout(updateLinePositions, 100);
                    
                    // And again after all resources are loaded
                    window.addEventListener('load', updateLinePositions);
                    
                    // And one more time after a longer delay to be safe
                    setTimeout(updateLinePositions, 500);
                };
                
                // Start initialization
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', () => {
                        init();
                    });
                } else {
                    init();
                }
                
                // Update on window resize with debounce
                let resizeTimer;
                window.addEventListener('resize', () => {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => {
                        requestAnimationFrame(updateLinePositions);
                    }, 100);
                });
                
                // Update on scroll with debounce
                let scrollTimer;
                const handleScroll = () => {
                    if (!scrollTimer) {
                        requestAnimationFrame(() => {
                            updateLinePositions();
                            scrollTimer = null;
                        });
                    }
                };
                
                window.addEventListener('scroll', handleScroll, { passive: true });
                
                // Force update after a short delay to ensure everything is in place
                setTimeout(updateLinePositions, 1000);
            });
            </script>
        </x-ui.container>
    </section>

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

                <!-- Training & Capacity Building -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all text-center">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 mx-auto">
                        <x-heroicon-o-academic-cap class="w-6 h-6 text-primary" />
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Training & Capacity Building</h3>
                    <p class="text-muted-foreground text-sm">Hands-on skills in precision agriculture and AI-powered decision-making to maximize productivity.</p>
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

