<div>
    <!-- Hero Section -->
    <x-ui.hero
        image="{{ asset('images/hero/hero1.webp') }}"
        heading="Our Partners"
        subheading="Collaborating with organizations that share our vision for sustainable agriculture and rural development."
        height="500px"
        class="text-white"
    />

    <x-ui.vstack>
        <!-- Strategic Partners Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Strategic Partners"
                    description="Organizations that provide critical support and collaboration for our programs."
                />

                <!-- Strategic Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-ui.partner-card
                        name="MasterCard Foundation"
                        description="The Mastercard Foundation works with visionary organizations to enable young people in Africa and in Indigenous communities in Canada to access dignified and fulfilling work."
                        website="https://mastercardfdn.org"
                        category="Strategic Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="AWARD"
                        description="African Women in Agricultural Research and Development (AWARD) works toward inclusive, agriculture-driven prosperity for Africa by strengthening the production and dissemination of more gender-responsive agricultural research and innovation."
                        website="https://awardfellowships.org"
                        category="Strategic Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="Anzisha Prize"
                        description="The Anzisha Prize is Africa's biggest award for young entrepreneurs aged 15-22 and is a partnership between African Leadership Academy and Mastercard Foundation."
                        website="https://anzishaprize.org"
                        category="Strategic Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="African Leadership Academy"
                        description="African Leadership Academy seeks to transform Africa by developing a powerful network of young leaders who will work together to address Africa's greatest challenges."
                        website="https://africanleadershipacademy.org"
                        category="Strategic Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="Talloires Network"
                        description="The Talloires Network is an international association of institutions committed to strengthening the civic roles and social responsibilities of higher education."
                        website="https://talloiresnetwork.tufts.edu"
                        category="Strategic Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="University of Pretoria"
                        description="The University of Pretoria is one of Africa's top universities and the largest contact university in South Africa, with a focus on research and agricultural innovation."
                        website="https://www.up.ac.za"
                        category="Strategic Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />
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

                <!-- Research Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-ui.partner-card
                        name="ICRISAT"
                        description="The International Crops Research Institute for the Semi-Arid Tropics (ICRISAT) is an international organization that conducts agricultural research for rural development."
                        website="https://www.icrisat.org"
                        category="Research Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="Department of Agricultural Research"
                        description="Malawi's Department of Agricultural Research conducts research on crops, livestock, and natural resources to improve agricultural productivity and sustainability."
                        website="https://www.malawi.gov.mw"
                        category="Research Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="CARE International"
                        description="CARE is a global leader within a worldwide movement dedicated to ending poverty and achieving social justice."
                        website="https://www.care.org"
                        category="Research Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />
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

                <!-- Implementation Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-ui.partner-card
                        name="Self Help Africa"
                        description="Self Help Africa is an international development organization that works through agriculture to end hunger and poverty in rural Africa."
                        website="https://selfhelpafrica.org"
                        category="Implementation Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="Local Government Authorities"
                        description="We work closely with district councils and local government authorities to ensure our programs align with local development priorities."
                        website="#"
                        category="Implementation Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />

                    <x-ui.partner-card
                        name="Farmer Cooperatives"
                        description="We partner with local farmer cooperatives to implement our programs and ensure community ownership and sustainability."
                        website="#"
                        category="Implementation Partner"
                        logo="{{ asset('images/logos/mastercard.png') }}"
                    />
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
