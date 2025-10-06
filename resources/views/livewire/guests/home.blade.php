<div>
    
    <!-- Hero Section -->
    <x-ui.landing-hero
        heading="Empowering Farmers, Building Futures"
        height="700px"
    />


    <x-ui.vstack>
    <!-- Impact Section -->
    <section class="bg-muted/30 py-12">
        <x-ui.container>
            <x-ui.section-header
                title="Our Impact (2025)"
            />

            <!-- Impact Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
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
        </x-ui.container>
    </section>

    <x-ui.feature-section
        title="Our Integrated Model"
        description="HarvestGlow's approach combines four key elements to create sustainable agricultural systems that empower farmers and build resilient communities."
    >
        <x-ui.feature-card
            title="Seed Access & Multiplication"
            description="Creating locally controlled seed supply chains through farmer-led multiplication in Seed Villages."
            icon="heroicon-o-sparkles"
        />

        <x-ui.feature-card
            title="Village Savings & Loans"
            description="Building financial resilience through community-based savings groups and cooperative ownership."
            icon="heroicon-o-banknotes"
        />

        <x-ui.feature-card
            title="Value-Added Processing"
            description="Enabling farmers to process crops into high-value products, increasing income and creating jobs."
            icon="heroicon-o-building-storefront"
        />

        <x-ui.feature-card
            title="Climate-Smart Training"
            description="Providing hands-on training in conservation agriculture and climate adaptation techniques."
            icon="heroicon-o-sun"
        />
    </x-ui.feature-section>

    <!-- Products Section -->
    <section>
        <x-ui.container>
            <x-ui.section-header
                title="Our Products"
                description="Through our value-added processing initiatives, we help farmers transform raw crops into high-quality products."
            />

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <x-ui.product-card
                    title="Peanut Butter"
                    description="Locally produced, nutritious peanut butter made from high-quality groundnuts grown by our farmer network."
                    image="{{ asset('images/products/peanut-butter.jpg') }}"
                />

                <x-ui.product-card
                    title="Soy Milk"
                    description="Plant-based milk alternative rich in protein and essential nutrients, supporting dietary diversity."
                    image="{{ asset('images/products/soy-milk.jpg') }}"
                />

                <x-ui.product-card
                    title="Cooking Oil"
                    description="Pure, cold-pressed cooking oil produced from locally grown oilseeds, providing a healthy cooking option."
                    image="{{ asset('images/products/cooking-oil.jpg') }}"
                />
            </div>
        </x-ui.container>
    </section>

    <!-- Progress Section -->
    <section>
        <x-ui.container>
            <x-ui.section-header
                title="Progress Toward Our 2028 Goals"
                description="We're working to reach 10,000 farmers, achieve 50% certified seed adoption, and increase average household incomes by 40%."
            />

            <!-- Progress Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.progress-card
                    title="Farmers Reached"
                    :progress="10"
                    current="1,000"
                    goal="10,000"
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
    <section>
        <x-ui.container>
            <x-ui.section-header
                title="Latest News & Updates"
                description="Stay informed about our latest activities, success stories, and impact in communities across Malawi."
            />

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <x-ui.news-card
                    title="Empowering Farmers Through Seed Multiplication"
                    excerpt="Our Seed Villages program has helped over 1,000 farmers gain access to certified seeds, increasing crop yields by 40%."
                    date="January 15, 2025"
                    image="{{ asset('images/hero/hero1.webp') }}"
                    link="{{ route('news-details', ['slug' => 'empowering-farmers-seed-multiplication']) }}"
                />

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
            </div>
        </x-ui.container>
    </section>

    <!-- Partners Section -->
    <section>
        <x-ui.container>
            <x-ui.section-header
                title="Our Partners"
                description="We collaborate with organizations that share our vision for sustainable agriculture and rural development."
            />

            <!-- Partners Logos -->
            <div class="flex flex-wrap justify-center items-center gap-4 mb-8">
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/mastercard.png') }}" alt="Mastercard Foundation" class="h-full w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/Woman research award.png') }}" alt="AWARD - African Women in Agricultural Research and Development" class="h-full w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/anzisha prize.png') }}" alt="Anzisha Prize" class="h-full w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/ala.png') }}" alt="African Leadership Academy" class="h-full w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                </div>
                <div class="flex items-center justify-center h-24 w-48 bg-card rounded-lg shadow-sm border border-border p-4 hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/partners/university_of_pretoria.png') }}" alt="University of Pretoria" class="h-full w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                </div>
            </div>

        
        </x-ui.container>
    </section>
    </x-ui.vstack>
</div>


