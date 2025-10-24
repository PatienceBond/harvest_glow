<div>
    <!-- Hero Section -->
    @if($heroSection)
        <x-ui.hero
            image="{{ $heroSection->image ? Storage::url($heroSection->image) : asset('images/hero/hero1.webp') }}"
            heading="{{ $heroSection->heading }}"
            subheading="{{ $heroSection->subheading }}"
            height="{{ $heroSection->height }}"
            class="text-white"
        />
    @else
        <x-ui.hero
            image="{{ asset('images/hero/hero1.webp') }}"
            heading="Our Model"
            height="380px"
            class="text-white"
            align="center"
            headingClass="text-4xl md:text-5xl"
            contentPaddingClass="py-16 md:py-20"
        />
    @endif

    <x-ui.vstack>
        <!-- How Our Model Works Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="How Our Model Works"
                    description="HarvestGlow's integrated approach combines four key elements to create sustainable agricultural systems that empower farmers and build resilient communities."
                />

                <!-- Tabs Navigation -->
                <div class="border-b border-border mb-8" x-data="{ activeTab: 'seed' }">
                    <div class="flex flex-wrap gap-2 -mb-px">
                        <button
                            @click="activeTab = 'seed'"
                            :class="activeTab === 'seed' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border'"
                            class="px-6 py-3 border-b-2 font-medium transition"
                        >
                            Seed Access
                        </button>
                        <button
                            @click="activeTab = 'vsl'"
                            :class="activeTab === 'vsl' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border'"
                            class="px-6 py-3 border-b-2 font-medium transition"
                        >
                            VSL
                        </button>
                        <button
                            @click="activeTab = 'processing'"
                            :class="activeTab === 'processing' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border'"
                            class="px-6 py-3 border-b-2 font-medium transition"
                        >
                            Processing
                        </button>
                        <button
                            @click="activeTab = 'training'"
                            :class="activeTab === 'training' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border'"
                            class="px-6 py-3 border-b-2 font-medium transition"
                        >
                            Training
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div class="mt-8">
                        <!-- Seed Access Tab -->
                        <x-ui.tab-section id="seed" title="Seed Access & Multiplication" icon="heroicon-o-beaker">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div>
                                    <p class="text-lg mb-6">
                                        HarvestGlow sources certified seed for farmer-led multiplication in Seed Villages, creating locally controlled supply chains. Farmers receive training on improved agronomic practices and post-harvest handling.
                                    </p>
                                    <p class="text-lg mb-6">
                                        The model increases productivity, reduces dependency on recycled seed, and positions communities as regional seed suppliers.
                                    </p>

                                    <div class="bg-primary/5 border border-primary/20 rounded-lg p-6 mb-6">
                                        <h4 class="font-bold text-lg mb-3">Case Example</h4>
                                        <p class="text-muted-foreground">
                                            Lucy Tembo of Kasungu increased maize production from 1.5 to 4 tons per hectare in one season using HarvestGlow-certified seed.
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-xl mb-4">Key Benefits</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">2-3x increase in crop yields</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Local seed availability</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Reduced dependency on external suppliers</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Income generation through seed sales</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </x-ui.tab-section>

                        <!-- VSL Tab -->
                        <x-ui.tab-section id="vsl" title="Village Savings & Loans (VSLs)" icon="heroicon-o-banknotes">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div>
                                    <p class="text-lg mb-6">
                                        Farmers form groups of 15–25 members to save weekly, access loans, and co-invest in seeds, processing units, and other income-generating activities.
                                    </p>
                                    <p class="text-lg mb-6">
                                        VSLs build financial resilience, promote cooperative ownership, and facilitate collective market engagement. By 2028, we aim for 50% of VSL participants to be women, ensuring equity and empowerment.
                                    </p>

                                    <div class="bg-secondary/5 border border-secondary/20 rounded-lg p-6">
                                        <h4 class="font-bold text-lg mb-3">How It Works</h4>
                                        <ul class="space-y-2">
                                            <li class="flex items-start gap-2">
                                                <x-heroicon-o-arrow-right class="w-5 h-5 text-secondary flex-shrink-0 mt-0.5" />
                                                <span>Members contribute weekly savings</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <x-heroicon-o-arrow-right class="w-5 h-5 text-secondary flex-shrink-0 mt-0.5" />
                                                <span>Group provides low-interest loans to members</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <x-heroicon-o-arrow-right class="w-5 h-5 text-secondary flex-shrink-0 mt-0.5" />
                                                <span>Interest builds group capital</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <x-heroicon-o-arrow-right class="w-5 h-5 text-secondary flex-shrink-0 mt-0.5" />
                                                <span>Annual share-out distributes profits</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-xl mb-4">Key Benefits</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-secondary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Access to credit without formal banking</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-secondary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Community-owned financial services</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-secondary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Collective investment in equipment</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-secondary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Financial literacy development</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </x-ui.tab-section>

                        <!-- Processing Tab -->
                        <x-ui.tab-section id="processing" title="Value-Added Processing" icon="heroicon-o-cog-6-tooth">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div>
                                    <p class="text-lg mb-6">
                                        Shared solar-powered equipment enables farmers to process crops into high-value products such as cooking oil, peanut butter, soy milk, and animal feed.
                                    </p>
                                    <p class="text-lg mb-6">
                                        Processing increases household income by 30–50% and creates new employment opportunities. Our approach ensures products meet quality standards, connecting farmers to reliable regional markets.
                                    </p>

                                    <div class="bg-success/5 border border-success/20 rounded-lg p-6">
                                        <h4 class="font-bold text-lg mb-3">Case Example</h4>
                                        <p class="text-muted-foreground">
                                            A community peanut processing unit increased local income by $8,000 in the first year while reducing post-harvest losses by 25%.
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-xl mb-4">Key Products</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-success flex-shrink-0 mt-1" />
                                            <span class="text-lg">Peanut butter</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-success flex-shrink-0 mt-1" />
                                            <span class="text-lg">Cooking oil</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-success flex-shrink-0 mt-1" />
                                            <span class="text-lg">Soy milk</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-success flex-shrink-0 mt-1" />
                                            <span class="text-lg">Soy flour</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-success flex-shrink-0 mt-1" />
                                            <span class="text-lg">Plant-based juices</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </x-ui.tab-section>

                        <!-- Training Tab -->
                        <x-ui.tab-section id="training" title="Climate-Smart Training & Digital Monitoring" icon="heroicon-o-academic-cap">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div>
                                    <p class="text-lg mb-6">
                                        Farmers receive hands-on training in conservation agriculture, irrigation management, climate adaptation, and post-harvest handling.
                                    </p>
                                    <p class="text-lg mb-6">
                                        Mobile applications track seed adoption, yields, savings, and enterprise performance. Digital dashboards provide real-time reporting for investors and stakeholders, enhancing transparency and informed decision-making.
                                    </p>
                                </div>

                                <div>
                                    <h4 class="font-bold text-xl mb-4">Training Areas</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Agronomic practices</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Soil management</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Post-harvest handling</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Climate adaptation techniques</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                            <span class="text-lg">Data management and analysis</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </x-ui.tab-section>
                    </div>
                </div>
            </x-ui.container>
        </section>

        <!-- Products Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Our Value-Added Products"
                />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <x-ui.product-card
                        image="{{ asset('images/products/peanut-butter.jpg') }}"
                        title="Peanut Butter"
                        description="Nutritious, locally-produced peanut butter made from high-quality groundnuts."
                    />

                    <x-ui.product-card
                        image="{{ asset('images/products/soy-milk.jpg') }}"
                        title="Soy Milk"
                        description="Plant-based milk alternative rich in protein and essential nutrients."
                    />

                    <x-ui.product-card
                        image="{{ asset('images/products/cooking-oil.jpg') }}"
                        title="Cooking Oil"
                        description="Pure, cold-pressed cooking oil from locally grown oilseeds."
                    />

                    <x-ui.product-card
                        image="{{ asset('images/products/soy-milk.jpg') }}"
                        title="Soy Cake"
                        description="Protein-rich animal feed byproduct from soy processing."
                    />

                    <x-ui.product-card
                        image="{{ asset('images/products/peanut-butter.jpg') }}"
                        title="Soy Flour"
                        description="Versatile, protein-rich flour for baking and cooking."
                    />

                    <x-ui.product-card
                        image="{{ asset('images/products/cooking-oil.jpg') }}"
                        title="Plant-Based Juices"
                        description="Traditional and nutritious juices like Chidede made from local plants."
                    />
                </div>
            </x-ui.container>
        </section>

        <!-- Investment Models Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Investment Models"
                    description="Different ways to support and partner with HarvestGlow for sustainable impact."
                />

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <x-ui.investment-card
                        title="Seed Equity Model"
                        description="Investors fund seed multiplication initiatives and receive a share of profits from seed sales."
                        :features="[
                            'Direct investment in seed production',
                            'Revenue sharing from seed sales',
                            'Measurable social impact',
                            'Sustainable business model'
                        ]"
                        roi="Projected ROI: 15-20% annually after Year 2"
                    />

                    <x-ui.investment-card
                        title="Impact Fund Model"
                        description="Capital supports VSLs and processing units with a focus on social returns plus modest revenue sharing."
                        :features="[
                            'Blended financial and social returns',
                            'Support for community enterprises',
                            'Detailed impact reporting',
                            'Long-term partnership approach'
                        ]"
                        roi="Projected ROI: 8-12% annually + measured social impact"
                    />

                    <x-ui.investment-card
                        title="Blended Finance Model"
                        description="Combines grants, low-interest loans, and equity investments to ensure scalability and sustainability."
                        :features="[
                            'Flexible capital structure',
                            'Phased investment approach',
                            'Risk mitigation through diversification',
                            'Suitable for institutional investors'
                        ]"
                        roi="Projected ROI: Varies by component (5-15% overall)"
                    />

                </div>
                <div class="bg-success/5 border border-success/20 rounded-lg p-6  mb-12">
                    <h3 class="text-2xl font-bold mb-3">Sustainability Model</h3>
                    <p class="text-muted-foreground mb-6">By Year 5, 70% of operations will be self-financed through revenue streams.</p>

                    <div class="flex items-center gap-3">
                        <x-heroicon-o-chart-bar class="w-8 h-8 text-success" />
                        <span class="text-lg font-semibold">Long-term Financial Sustainability</span>
                    </div>
                </div>

                <!-- Revenue Streams -->
                <div class="mb-12">
                    <h3 class="text-3xl font-bold mb-6">Revenue Streams</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.revenue-card
                            icon="heroicon-o-beaker"
                            title="Seed Sales"
                            description="Certified seeds sold through farmer cooperatives to local markets and other farmers."
                        />

                        <x-ui.revenue-card
                            icon="heroicon-o-shopping-bag"
                            title="Value-Added Products"
                            description="Sales of processed products including cooking oil, soy milk, and peanut butter."
                        />

                        <x-ui.revenue-card
                            icon="heroicon-o-academic-cap"
                            title="Training Services"
                            description="Climate-smart agriculture modules and training provided to other organizations and projects."
                        />

                        <x-ui.revenue-card
                            icon="heroicon-o-chart-bar"
                            title="Data & Impact Services"
                            description="Digital tools, dashboards, and impact measurement services for partners and stakeholders."
                        />
                    </div>
                </div>

                <!-- Financial Sustainability Projection -->
                <div>
                    <h3 class="text-3xl font-bold mb-6">Financial Sustainability Projection</h3>
                    <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                        <x-ui.progress-card
                            title="Year 1"
                            progress="10"
                            current="10% self-financed"
                            goal="Goal: Initial revenue streams"
                        />

                        <x-ui.progress-card
                            title="Year 3"
                            progress="40"
                            current="40% self-financed"
                            goal="Goal: Operational break-even"
                        />

                        <x-ui.progress-card
                            title="Year 5"
                            progress="70"
                            current="70% self-financed"
                            goal="Goal: Financial sustainability"
                        />
                    </div>
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
