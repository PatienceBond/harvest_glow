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
            heading="Impact by the Numbers"
            subheading="Our work is creating measurable change in communities across Malawi."
            height="500px"
            class="text-white"
        />
    @endif

    <x-ui.vstack>
        <!-- Impact Metrics Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Impact by the Numbers"
                    description="Our work is creating measurable change in communities across Malawi."
                />

                <!-- Impact Metrics Grid - Dynamic from Database -->
                @if($featuredMetrics && $featuredMetrics->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                        @foreach($featuredMetrics as $metric)
                            <x-ui.impact-metric-card
                                value="{{ $metric->value }}{{ $metric->unit ? $metric->unit : '' }}"
                                title="{{ $metric->title }}"
                                description="{{ $metric->description }}"
                                icon="heroicon-o-{{ $metric->icon ?? 'chart-bar' }}"
                            />
                        @endforeach
                    </div>
                @else
                    <!-- Fallback if no metrics -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                        <x-ui.impact-metric-card
                            value="100,000+"
                            title="Farmers Engaged"
                            description="Smallholder farmers provided with access to certified seeds, training, and credit facilities."
                            icon="heroicon-o-users"
                        />

                        <x-ui.impact-metric-card
                            value="500+"
                            title="Communities Served"
                            description="Rural communities receiving agricultural support and annual medical outreach services."
                            icon="heroicon-o-building-office-2"
                        />

                        <x-ui.impact-metric-card
                            value="10,855+"
                            title="Metric Tons Produced"
                            description="Increased crop production through certified seed access and improved farming techniques."
                            icon="heroicon-o-scale"
                        />

                        <x-ui.impact-metric-card
                            value="40%"
                            title="Income Increase"
                            description="Average household income growth for participating farmers through improved yields and value addition."
                            icon="heroicon-o-arrow-trending-up"
                        />
                    </div>
                @endif
            </x-ui.container>
        </section>

        <!-- Progress Toward Goals Section -->
        <section class="bg-muted/30">
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

                <!-- Goal Descriptions -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-primary/5 border border-primary/20 rounded-lg p-6">
                        <h4 class="font-bold text-lg mb-3">Farmers Reached</h4>
                        <p class="text-muted-foreground">
                            We're expanding our reach through partnerships with local agricultural extension services and community leaders.
                        </p>
                    </div>

                    <div class="bg-secondary/5 border border-secondary/20 rounded-lg p-6">
                        <h4 class="font-bold text-lg mb-3">Certified Seed Adoption</h4>
                        <p class="text-muted-foreground">
                            Farmer-led demonstrations and seed multiplication villages are accelerating adoption of certified seeds.
                        </p>
                    </div>

                    <div class="bg-success/5 border border-success/20 rounded-lg p-6">
                        <h4 class="font-bold text-lg mb-3">Income Increase</h4>
                        <p class="text-muted-foreground">
                            Value-added processing and improved market access are driving significant income improvements.
                        </p>
                    </div>

                    <div class="bg-primary/5 border border-primary/20 rounded-lg p-6">
                        <h4 class="font-bold text-lg mb-3">Women Participation</h4>
                        <p class="text-muted-foreground">
                            Women-led VSL groups and targeted training programs are increasing female participation in all aspects of our work.
                        </p>
                    </div>
                </div>
            </x-ui.container>
        </section>

        <!-- Key Impact Areas Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Key Impact Areas"
                    description="Our work creates positive change across multiple dimensions of rural life."
                />

                <!-- Impact Areas Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <x-ui.impact-area-card
                        title="Food Security"
                        description="Improved crop yields and diversified food production are reducing hunger and malnutrition in rural communities."
                        icon="heroicon-o-heart"
                        :features="[
                            '2-3x increase in staple crop yields',
                            'Diversified food production',
                            'Reduced seasonal hunger periods',
                            'Improved nutritional outcomes'
                        ]"
                    />

                    <x-ui.impact-area-card
                        title="Economic Empowerment"
                        description="Increased incomes and financial inclusion are creating new economic opportunities for rural households."
                        icon="heroicon-o-banknotes"
                        :features="[
                            '40% average income increase',
                            'Access to credit through VSLs',
                            'New employment in processing',
                            'Reduced economic migration'
                        ]"
                    />

                    <x-ui.impact-area-card
                        title="Climate Resilience"
                        description="Climate-smart agricultural practices are helping farmers adapt to changing weather patterns and environmental challenges."
                        icon="heroicon-o-sun"
                        :features="[
                            'Improved water management',
                            'Drought-resistant crop varieties',
                            'Soil conservation techniques',
                            'Reduced crop losses to climate events'
                        ]"
                    />
                </div>
            </x-ui.container>
        </section>

        <!-- Farmer Stories Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Farmer Stories"
                    description="Real stories of transformation from the farmers we work with."
                />

                <!-- Farmer Stories Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-ui.farmer-story-card
                        name="Mary Banda"
                        location="Kasungu, Malawi"
                        story="Since joining HarvestGlow's seed program, my maize yield has increased from 1.5 to 4 tons per hectare. I can now pay for my children's education and have enough food for my family."
                    />

                    <x-ui.farmer-story-card
                        name="John Phiri"
                        location="Likuni, Malawi"
                        story="The village savings group has changed everything for us. We pooled our resources to buy a peanut processing machine, and now our community earns additional income from selling peanut butter."
                    />

                    <x-ui.farmer-story-card
                        name="Grace Mwanza"
                        location="Lilongwe, Malawi"
                        story="The climate-smart training taught me how to conserve water and prepare for changing weather patterns. Even during drought, my crops survived while others failed."
                    />

                    <x-ui.farmer-story-card
                        name="James Chirwa"
                        location="Mchinji, Malawi"
                        story="Before HarvestGlow, I struggled to feed my family. Now, with improved seeds and training, I produce enough to feed my family and sell the surplus. My income has doubled."
                    />

                    <x-ui.farmer-story-card
                        name="Sarah Gondwe"
                        location="Dowa, Malawi"
                        story="As a woman farmer, I never had access to credit before. Through the VSL group, I got a loan to buy inputs and now I'm one of the most successful farmers in my village."
                    />

                    <x-ui.farmer-story-card
                        name="Thomas Kaunda"
                        location="Ntchisi, Malawi"
                        story="Our community processing unit has created jobs for young people who were planning to leave for the city. Now they see a future in agriculture right here at home."
                    />
                </div>
            </x-ui.container>
        </section>

        <!-- Monitoring, Evaluation & Learning Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Monitoring, Evaluation & Learning"
                    description="Our rigorous approach to measuring impact ensures transparency and continuous improvement."
                />

                <!-- MEL Approach Description -->
                <div class="bg-primary/5 border border-primary/20 rounded-lg p-8 mb-12">
                    <h3 class="text-2xl font-bold mb-4">Our MEL Approach</h3>
                    <p class="text-lg text-muted-foreground mb-4">
                        HarvestGlow uses a comprehensive monitoring, evaluation, and learning system to track progress, measure outcomes, and continuously improve our programs.
                    </p>
                    <p class="text-lg text-muted-foreground">
                        Digital tools and dashboards provide real-time data on key metrics, allowing us to make informed decisions and report transparently to stakeholders.
                    </p>
                </div>

                <!-- MEL Categories Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-ui.mel-approach-card
                        title="Inputs Tracked"
                        description="We monitor the resources and activities that drive our impact."
                        :items="[
                            'Seed distribution',
                            'VSL savings',
                            'Training sessions',
                            'Equipment deployment'
                        ]"
                    />

                    <x-ui.mel-approach-card
                        title="Outputs Measured"
                        description="We track the direct results of our programs and activities."
                        :items="[
                            'Farmers reached',
                            'Women participation',
                            'Processing units established',
                            'Seed multiplication areas'
                        ]"
                    />

                    <x-ui.mel-approach-card
                        title="Outcomes Evaluated"
                        description="We measure the lasting changes in farmers' lives and communities."
                        :items="[
                            'Income increases',
                            'Seed adoption rates',
                            'Nutrition improvements',
                            'Climate resilience metrics'
                        ]"
                    />
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
