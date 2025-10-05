<div>
    <!-- Hero Section -->
    <x-ui.hero
        image="{{ asset('images/hero/hero1.webp') }}"
        heading="About HarvestGlow"
        subheading="Transforming Agriculture,"
        height="500px"
        class="text-white"
    />

    <x-ui.vstack>
        <!-- Vision & Mission Section -->
        <section>
            <x-ui.container>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Vision -->
                    <div class="bg-primary/5 border border-primary/20 rounded-lg p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <x-heroicon-o-eye class="w-8 h-8 text-primary" />
                            <h2 class="text-2xl font-bold">Our Vision</h2>
                        </div>
                        <p class="text-lg text-muted-foreground">
                            A Malawi where farmers, regardless of gender or age, thrive as seed multipliers, agri-entrepreneurs, and community leaders, creating food-secure, dignified, and self-sustaining rural economies.
                        </p>
                    </div>

                    <!-- Mission -->
                    <div class="bg-secondary/5 border border-secondary/20 rounded-lg p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <x-heroicon-o-rocket-launch class="w-8 h-8 text-secondary" />
                            <h2 class="text-2xl font-bold">Our Mission</h2>
                        </div>
                        <p class="text-lg text-muted-foreground">
                            To empower smallholder farmers by improving access to certified seeds, strengthening financial inclusion, and promoting value addition, thereby creating resilient, equitable, and community-owned agricultural systems.
                        </p>
                    </div>
                </div>
            </x-ui.container>
        </section>

        <!-- Core Values Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Our Core Values"
                    description="These principles guide our work and shape our approach to agricultural transformation."
                />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <x-ui.value-card
                        title="Equity"
                        description="Ensuring fair access to resources and opportunities for all farmers, especially women and youth."
                        icon="heroicon-o-scale"
                    />

                    <x-ui.value-card
                        title="Sustainability"
                        description="Promoting practices that meet present needs without compromising future generations."
                        icon="heroicon-o-arrow-path"
                    />

                    <x-ui.value-card
                        title="Innovation"
                        description="Finding creative solutions to agricultural challenges through technology and local knowledge."
                        icon="heroicon-o-light-bulb"
                    />

                    <x-ui.value-card
                        title="Resilience"
                        description="Building capacity to withstand and recover from climate shocks and market fluctuations."
                        icon="heroicon-o-shield-check"
                    />

                    <x-ui.value-card
                        title="Collaboration"
                        description="Working together with farmers, partners, and stakeholders to achieve shared goals."
                        icon="heroicon-o-user-group"
                    />
                </div>
            </x-ui.container>
        </section>

        <!-- Context and Problem Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Context and the Problem"
                />

                <div class="max-w-4xl mx-auto">
                    <p class="text-lg text-muted-foreground mb-6">
                        Malawi's smallholder farmers face chronic challenges. Over 70% recycle seeds annually, producing yields of only 1–2 tons/ha compared to 4–5 tons/ha with improved varieties.
                    </p>

                    <p class="text-lg text-muted-foreground mb-6">
                        Government subsidies totaling over $100M per year often reinforce dependency rather than build local capacity. Women, who provide 70% of farm labor, own less than 15% of land, limiting their economic agency.
                    </p>

                    <p class="text-lg text-muted-foreground">
                        Limited processing infrastructure further reduces market access, with value addition remaining below 10% in the agricultural sector. Climate shocks exacerbate vulnerabilities, reducing productivity and incomes.
                    </p>
                </div>
            </x-ui.container>
        </section>

        <!-- Challenges & Solutions Section -->
        <section>
            <x-ui.container>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Key Challenges -->
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <x-heroicon-o-exclamation-triangle class="w-8 h-8 text-destructive" />
                            <h2 class="text-3xl font-bold">Key Challenges</h2>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-x-circle class="w-6 h-6 text-destructive flex-shrink-0 mt-1" />
                                <span class="text-lg">Low productivity due to recycled seeds</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-x-circle class="w-6 h-6 text-destructive flex-shrink-0 mt-1" />
                                <span class="text-lg">Limited access to finance for farmers</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-x-circle class="w-6 h-6 text-destructive flex-shrink-0 mt-1" />
                                <span class="text-lg">Gender inequality in land ownership</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-x-circle class="w-6 h-6 text-destructive flex-shrink-0 mt-1" />
                                <span class="text-lg">Minimal value addition to raw products</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-x-circle class="w-6 h-6 text-destructive flex-shrink-0 mt-1" />
                                <span class="text-lg">Vulnerability to climate change</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Our Solutions -->
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <x-heroicon-o-light-bulb class="w-8 h-8 text-primary" />
                            <h2 class="text-3xl font-bold">Our Solutions</h2>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                <span class="text-lg">Community-owned seed systems</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                <span class="text-lg">Village Savings & Loans groups</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                <span class="text-lg">Women-led agricultural enterprises</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                <span class="text-lg">Small-scale processing units</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                                <span class="text-lg">Climate-smart training programs</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </x-ui.container>
        </section>

        <!-- Theory of Change Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Our Theory of Change"
                    description="How our integrated approach creates lasting impact for farmers and communities."
                />

                <div class="flex flex-col lg:flex-row gap-0 lg:gap-6 items-stretch">
                    <x-ui.theory-stage
                        title="Inputs"
                        :items="[
                            'Certified seeds and training',
                            'VSL formation and support',
                            'Processing equipment',
                            'Climate-smart agriculture techniques'
                        ]"
                        color="primary"
                        :showArrow="true"
                    />

                    <x-ui.theory-stage
                        title="Outputs"
                        :items="[
                            'Increased seed adoption',
                            'Functional savings groups',
                            'Operational processing units',
                            'Trained farmers using climate-smart practices'
                        ]"
                        color="secondary"
                        :showArrow="true"
                    />

                    <x-ui.theory-stage
                        title="Outcomes"
                        :items="[
                            'Higher crop yields',
                            'Increased household savings',
                            'Value-added products in markets',
                            'Greater climate resilience'
                        ]"
                        color="accent"
                        :showArrow="true"
                    />

                    <x-ui.theory-stage
                        title="Impact"
                        :items="[
                            '40% increase in household income',
                            'Improved food security',
                            'Greater gender equity',
                            'Sustainable, resilient communities'
                        ]"
                        color="primary"
                        :showArrow="false"
                    />
                </div>
            </x-ui.container>
        </section>

        <!-- 5-Year Growth Plan Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="5-Year Growth Plan"
                    description="Our roadmap for scaling impact and achieving sustainability."
                />

                <div class="max-w-3xl mx-auto">
                    <div class="relative border-l-4 border-primary pl-8 ml-8">
                        <x-ui.timeline-item
                            phase="1"
                            title="Year 1"
                            :items="[
                                'Pilot with 500 farmers',
                                'Establish 20 VSL groups',
                                'Set up 5 processing units',
                                'Develop training curriculum',
                                'Build initial partnerships'
                            ]"
                        />

                        <x-ui.timeline-item
                            phase="2-3"
                            title="Years 2-3"
                            :items="[
                                'Scale to 5,000 farmers',
                                'Establish regional seed cooperatives',
                                'Expand processing capacity',
                                'Develop market linkages',
                                'Achieve operational break-even'
                            ]"
                        />

                        <x-ui.timeline-item
                            phase="4-5"
                            title="Years 4-5"
                            :items="[
                                'Expand to 10,000+ farmers',
                                'Develop sustainable farmer-owned cooperatives',
                                'Achieve 70% self-financed operations',
                                'Establish regional distribution networks',
                                'Document model for replication'
                            ]"
                        />
                    </div>
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
