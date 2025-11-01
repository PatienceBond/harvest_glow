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
                    description="HarvestGlow transforms agriculture and strengthens communities through a smart, technology-driven model that integrates:"
                />

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                    <div class="flex items-start gap-3 p-4 border rounded-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-lg active:scale-[0.98]">
                        <x-heroicon-o-beaker class="w-7 h-7 text-primary flex-shrink-0" />
                        <div>
                            <h4 class="font-semibold">Seed Access</h4>
                            <p class="text-sm text-muted-foreground">Delivering high-quality, locally adapted seeds.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-4 border rounded-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-lg active:scale-[0.98]">
                        <x-heroicon-o-banknotes class="w-7 h-7 text-secondary flex-shrink-0" />
                        <div>
                            <h4 class="font-semibold">Village Savings & Loans (VSLs)</h4>
                            <p class="text-sm text-muted-foreground">Empowering farmers with financial tools to invest in their farms.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-4 border rounded-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-lg active:scale-[0.98]">
                        <x-heroicon-o-cog-6-tooth class="w-7 h-7 text-success flex-shrink-0" />
                        <div>
                            <h4 class="font-semibold">Processing & Value Addition</h4>
                            <p class="text-sm text-muted-foreground">Enhancing local agro-processing to boost incomes and reduce post-harvest losses.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-4 border rounded-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-lg active:scale-[0.98]">
                        <x-heroicon-o-academic-cap class="w-7 h-7 text-primary flex-shrink-0" />
                        <div>
                            <h4 class="font-semibold">Training & Capacity Building</h4>
                            <p class="text-sm text-muted-foreground">Hands-on skills in precision agriculture and AI-powered decision-making to maximize productivity.</p>
                        </div>
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="mt-8"></div>
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
