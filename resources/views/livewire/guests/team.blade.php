<div>
    <!-- Hero Section -->
    <x-ui.hero
        image="{{ asset('images/hero/hero1.webp') }}"
        heading="Our Team"
        subheading="Meet the dedicated professionals working to transform agriculture in Malawi."
        height="500px"
        class="text-white"
    />

    <x-ui.vstack>
        <!-- Leadership Team Section -->
        <section>
            <x-ui.container>
                <x-ui.section-header
                    title="Leadership Team"
                    description="Our experienced leaders bring diverse expertise in agricultural science, operations, and community development."
                />

                <!-- Leadership Team Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-ui.team-member-card
                        name="Mphangera Kamanga"
                        title="Founder & Executive Director"
                        bio="An accomplished Agricultural Scientist and social innovator with expertise in agribusiness, field trials, and advanced data analytics. An AWARD Fellow, Anzisha Prize Idea Fellow and Mastercard Foundation Entrepreneurship Award Winner, Mphangera brings scientific rigor and entrepreneurial drive to build sustainable solutions for rural communities."
                        :is-leadership="true"
                    />

                    <x-ui.team-member-card
                        name="Adon Phiri"
                        title="Co-Founder & Chief Operations Officer"
                        bio="A well-qualified agronomist with expertise in seed production, crop management, and farmer training. Adon oversees large-scale agronomic operations, leads crop trials, and develops market strategies that connect farmers to improved seed systems and sustainable markets."
                        :is-leadership="true"
                    />

                    <x-ui.team-member-card
                        name="Clara Mbemba"
                        title="Finance and Accounting Manager"
                        bio="Clara possesses a robust skill set in finance and accounting, with strong analytical abilities in collecting, organizing, and analyzing financial data to support budgeting, auditing, and decision-making. She ensures compliance with budgets and regulations while maintaining data integrity."
                        :is-leadership="true"
                    />
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-ui.team-member-card
                        name="Franco Mwachande"
                        title="Communications, Marketing and Outreach Officer"
                        bio="Franco specializes in communications, media production, and public relations. At HarvestGlow, he leads storytelling, branding, and stakeholder engagement, ensuring the voices of farmers are amplified and the organization's impact is clearly communicated."
                    />

                    <x-ui.team-member-card
                        name="Ngale Ntandika"
                        title="Partnership and Stakeholder Engagement Specialist"
                        bio="Ngale drives agricultural innovation and community empowerment by designing and executing community engagement strategies, mobilizing women and youth for income-generating activities, and coordinating with stakeholders to ensure access to agricultural technologies and market linkages."
                    />

                    <x-ui.team-member-card
                        name="Sarah Chirwa"
                        title="Monitoring, Evaluation and Impact Measurement Officer"
                        bio="Sarah is a development practitioner focused on community development, gender issues, food security, VSL management and human rights. She oversees data collection, entry, management and report writing to ensure our programs meet their goals."
                    />

                    <x-ui.team-member-card
                        name="Grace Chiumia"
                        title="Human Resource, Logistics and Administrative Officer"
                        bio="As the HR and Administration Officer, Grace manages staff recruitment, employee records, office supplies, and internal communications. She supports program teams with logistical arrangements, documentation, and reporting while ensuring compliance with organizational policies."
                    />

                    <x-ui.team-member-card
                        name="Doreen Mfune"
                        title="Environmental and Social Safeguarding Officer"
                        bio="Doreen ensures projects comply with environmental laws through impact assessments and audits, manages social impacts on communities, prepares sustainability reports, and develops risk mitigation plans. She brings expertise in GIS, data analysis, and project monitoring."
                    />

                    <x-ui.team-member-card
                        name="Edward Banda"
                        title="Driver"
                        bio="Edward serves as a skilled Driver at HarvestGlow, ensuring efficient and safe transportation to support the organization's agricultural and community outreach efforts. He maintains accurate logs for fuel and mileage, and adheres to safety protocols during field operations."
                    />
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
                    <x-ui.board-member-card
                        name="Dr. Grace Ramafi"
                        role="Board Chair"
                    />

                    <x-ui.board-member-card
                        name="Susan Mantchombe"
                        role="Board Member"
                    />

                    <x-ui.board-member-card
                        name="Joanna Fatch"
                        role="Board Member"
                    />

                    <x-ui.board-member-card
                        name="John Njalammano"
                        role="Board Member"
                    />
                </div>
            </x-ui.container>
        </section>
    </x-ui.vstack>
</div>
