<div>
    <!-- Hero Section -->
    @if($heroSection)
        <x-ui.hero
            image="{{ $heroSection->image ? Storage::url($heroSection->image) : asset('images/hero/hero1.webp') }}"
            heading="{{ $heroSection->heading }}"
            subheading=""
            height="350px"
            align="center"
            headingClass="text-3xl md:text-4xl font-bold"
            subheadingClass="text-lg md:text-xl"
            contentPaddingClass="py-20"
            class="text-white"
        />
    @else
        <x-ui.hero
            image="{{ asset('images/hero/hero1.webp') }}"
            heading="Our Team"
            subheading=""
            height="350px"
            align="center"
            headingClass="text-3xl md:text-4xl font-bold"
            subheadingClass="text-lg md:text-xl"
            contentPaddingClass="py-20"
            class="text-white"
        />
    @endif

    <x-ui.vstack>
        <!-- Leadership Team Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Leadership Team"
                    description="Our experienced leaders bring diverse expertise in agricultural science, operations, and community development."
                />

                <!-- Leadership Team Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($leadershipTeam as $member)
                        <x-ui.team-member-card
                            :name="$member->name"
                            :title="$member->title"
                            :bio="$member->bio"
                            :image="$member->photo ? Storage::url($member->photo) : null"
                            :is-leadership="true"
                        />
                    @empty
                        <p class="text-center text-muted-foreground col-span-full">No leadership team members added yet.</p>
                    @endforelse
                </div>
            </x-ui.container>
        </section>

        <!-- Team Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Our Team"
                    description="The dedicated professionals who make our work possible."
                />

                <!-- Team Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($ourTeam as $member)
                        <x-ui.team-member-card
                            :name="$member->name"
                            :title="$member->title"
                            :bio="$member->bio"
                            :image="$member->photo ? Storage::url($member->photo) : null"
                        />
                    @empty
                        <p class="text-center text-muted-foreground col-span-full">No team members added yet.</p>
                    @endforelse
                </div>
            </x-ui.container>
        </section>

        <!-- Board of Directors Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Board of Directors"
                    description="Our board provides strategic guidance and oversight to ensure we achieve our mission."
                />

                <!-- Board Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($boardMembers as $member)
                        <x-ui.board-member-card
                            :name="$member->name"
                            :role="$member->title"
                            :image="$member->photo ? Storage::url($member->photo) : null"
                        />
                    @empty
                        <p class="text-center text-muted-foreground col-span-full">No board members added yet.</p>
                    @endforelse
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
