<div>
    <!-- Hero Section -->
    <x-ui.hero
        image="{{ asset('images/hero/hero1.webp') }}"
        heading="Contact Us"
        subheading="Get in touch with our team to learn more about our work or explore collaboration opportunities."
        height="500px"
        class="text-white"
    />

    <x-ui.vstack>
        <!-- Get in Touch Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Get in Touch"
                    description="Whether you have questions about our programs, want to explore partnership opportunities, or are interested in supporting our work, we'd love to hear from you."
                />

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Information -->
                    <div class="space-y-6">
                        <x-ui.contact-info-card
                            icon="heroicon-o-map-pin"
                            title="Office Location"
                            content="HarvestGlow<br>Likuni, Lilongwe<br>Malawi"
                        />

                        <x-ui.contact-info-card
                            icon="heroicon-o-envelope"
                            title="Email"
                            content="info@harvestglow.org"
                        />

                        <x-ui.contact-info-card
                            icon="heroicon-o-phone"
                            title="Phone"
                            content="+265 880 856 731<br>+265 996 084 781"
                        />

                        <x-ui.contact-info-card
                            icon="heroicon-o-share"
                            title="Follow Us"
                            content="Connect with us on social media for updates and news"
                        />
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-card border border-border rounded-lg p-8">
                        <h3 class="text-2xl font-bold mb-6">Send Us a Message</h3>
                        <x-ui.contact-form />
                    </div>
                </div>
            </x-ui.container>
        </section>

        <!-- Visit Our Office Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Map Placeholder -->
                    <div>
                        <h2 class="text-3xl font-bold mb-4">Visit Our Office</h2>
                        <p class="text-lg text-muted-foreground mb-6">
                            We're located in Likuni, Lilongwe, Malawi. Feel free to visit us during business hours.
                        </p>
                        
                        <!-- Map Placeholder -->
                        <div class="bg-card border border-border rounded-lg h-96 flex items-center justify-center">
                            <div class="text-center text-muted-foreground">
                                <x-heroicon-o-map-pin class="w-16 h-16 mx-auto mb-4 text-primary" />
                                <p class="text-lg font-medium">Interactive map would be displayed here</p>
                                <p class="text-sm">Likuni, Lilongwe, Malawi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div>
                        <h2 class="text-3xl font-bold mb-6">Business Hours</h2>
                        <div class="bg-card border border-border rounded-lg p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Monday - Friday</span>
                                <span class="text-muted-foreground">8:00 AM - 5:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Saturday</span>
                                <span class="text-muted-foreground">9:00 AM - 1:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Sunday</span>
                                <span class="text-muted-foreground">Closed</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Public Holidays</span>
                                <span class="text-muted-foreground">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.container>
        </section>

        <!-- FAQ Section -->
        <section class="bg-muted/30">
            <x-ui.container>
                <x-ui.section-header
                    title="Frequently Asked Questions"
                    description="Find answers to common questions about our work and how you can get involved."
                />

                <div class="max-w-4xl mx-auto">
                    <div class="bg-card border border-border rounded-lg p-6">
                        <div x-data="{ activeFaq: null }">
                            <div x-data="{ open: activeFaq === 0 }">
                                <x-ui.faq-item 
                                    question="How can I donate to HarvestGlow?"
                                    answer="You can make a donation through our website, by bank transfer, or by check. For details, please contact us at info@harvestglow.org or visit our Get Involved page."
                                />
                            </div>

                            <div x-data="{ open: activeFaq === 1 }">
                                <x-ui.faq-item 
                                    question="What percentage of my donation goes directly to programs?"
                                    answer="We are committed to financial transparency and efficiency. At least 85% of all donations go directly to our programs supporting farmers in Malawi."
                                />
                            </div>

                            <div x-data="{ open: activeFaq === 2 }">
                                <x-ui.faq-item 
                                    question="How can I volunteer with HarvestGlow?"
                                    answer="We welcome volunteers with various skills and backgrounds. Please fill out the volunteer form on our Get Involved page, and our team will contact you to discuss opportunities that match your skills and interests."
                                />
                            </div>

                            <div x-data="{ open: activeFaq === 3 }">
                                <x-ui.faq-item 
                                    question="Does HarvestGlow offer internships?"
                                    answer="Yes, we offer internships for students and recent graduates interested in agricultural development, social enterprise, and community development. Please contact us for current opportunities."
                                />
                            </div>

                            <div x-data="{ open: activeFaq === 4 }">
                                <x-ui.faq-item 
                                    question="How can my organization partner with HarvestGlow?"
                                    answer="We're always open to partnerships that align with our mission. Please contact us with details about your organization and your partnership ideas, and our team will follow up to explore collaboration opportunities."
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
