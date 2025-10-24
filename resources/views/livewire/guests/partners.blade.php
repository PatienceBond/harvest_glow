<div>
    <!-- Hero Section (From Database) -->
    @if($heroSection)
        <x-ui.hero
            image="{{ $heroSection->image ? Storage::url($heroSection->image) : asset('images/hero/hero1.webp') }}"
            heading="{{ $heroSection->heading }}"
            subheading=""
            height="350px"
            align="center"
            headingClass="text-3xl md:text-4xl font-bold"
            contentPaddingClass="py-20"
            class="text-white"
        />
    @else
        <x-ui.hero
            image="{{ asset('images/hero/hero1.webp') }}"
            heading="Our Partners"
            height="350px"
            align="center"
            headingClass="text-3xl md:text-4xl font-bold"
            contentPaddingClass="py-20"
            class="text-white"
        />
    @endif

    <x-ui.vstack>
        <!-- Strategic Partners Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Strategic Partners"
                    description="Organizations that provide critical support and collaboration for our programs."
                />

                <!-- Strategic Partners Grid (From Database) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($strategicPartners as $partner)
                        <x-ui.partner-card
                            name="{{ $partner->name }}"
                            description="{{ $partner->description }}"
                            website="{{ $partner->website }}"
                            category="{{ $partner->category }}"
                            logo="{{ $partner->logo ? Storage::url($partner->logo) : null }}"
                        />
                    @empty
                        <div class="col-span-full text-center py-8 text-muted-foreground">
                            <p>No strategic partners yet.</p>
                        </div>
                    @endforelse
                </div>
            </x-ui.container>
        </section>

        <!-- Research Partners Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Research Partners"
                    description="Institutions that collaborate with us on agricultural research and innovation."
                />

                <!-- Research Partners Grid (From Database) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($researchPartners as $partner)
                        <x-ui.partner-card
                            name="{{ $partner->name }}"
                            description="{{ $partner->description }}"
                            website="{{ $partner->website }}"
                            category="{{ $partner->category }}"
                            logo="{{ $partner->logo ? Storage::url($partner->logo) : null }}"
                        />
                    @empty
                        <div class="col-span-full text-center py-8 text-muted-foreground">
                            <p>No research partners yet.</p>
                        </div>
                    @endforelse
                </div>
            </x-ui.container>
        </section>

        <!-- Implementation Partners Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Implementation Partners"
                    description="Organizations that work with us to implement programs and reach communities."
                />

                <!-- Implementation Partners Grid (From Database) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($implementationPartners as $partner)
                        <x-ui.partner-card
                            name="{{ $partner->name }}"
                            description="{{ $partner->description }}"
                            website="{{ $partner->website }}"
                            category="{{ $partner->category }}"
                            logo="{{ $partner->logo ? Storage::url($partner->logo) : null }}"
                        />
                    @empty
                        <div class="col-span-full text-center py-8 text-muted-foreground">
                            <p>No implementation partners yet.</p>
                        </div>
                    @endforelse
                </div>
            </x-ui.container>
        </section>

        <!-- Partnership Call to Action -->
        <section class="bg-primary/5">
            <x-ui.container>
                <div class="text-center py-12">
                    <h2 class="text-3xl font-bold mb-4">Interested in Partnering with Us?</h2>
                    <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                        We're always looking for organizations that share our vision for sustainable agriculture and rural development. Let's work together to create lasting change.
                    </p>
                    <x-ui.button-link href="#contact" variant="primary" class="inline-flex items-center gap-2">
                        Get in Touch
                        <x-heroicon-o-arrow-right class="w-5 h-5" />
                    </x-ui.button-link>
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
