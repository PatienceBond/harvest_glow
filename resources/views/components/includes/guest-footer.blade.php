<!-- CTA Section -->
<section class="bg-primary py-16">
    <x-ui.container>
        <div class="text-center text-white">
            <h1 class="text-white mb-6">Join Us in Transforming Agriculture in Malawi</h1>
            <p class="text-lg mb-8 max-w-4xl mx-auto">
                Every $1 invested in HarvestGlow is projected to generate $4 in community income, along with strengthened food security and climate resilience.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-ui.button-link href="#invest" variant="card">
                    Invest in Our Work
                </x-ui.button-link>
                <x-ui.button-link href="#volunteer" variant="outline-white">
                    Volunteer With Us
                </x-ui.button-link>
               
            </div>
        </div>
    </x-ui.container>
</section>

<!-- Footer -->
<footer class="bg-slate-900 text-white py-12">
    <x-ui.container>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Column 1: Brand -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('logo/logo.png') }}" alt="HarvestGlow" class="h-8 w-auto">
                </div>
                <p class="text-sm text-gray-300 mb-6">
                    Empowering farmers, building resilient communities in Malawi.
                </p>
                <!-- Social Media Icons -->
                <div class="flex gap-4">
                    <a href="#" class="text-gray-300 hover:text-primary transition" title="WhatsApp">
                        <x-heroicon-o-phone class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary transition" title="Facebook">
                        <x-heroicon-o-user-group class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary transition" title="Instagram">
                        <x-heroicon-o-camera class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary transition" title="LinkedIn">
                        <x-heroicon-o-briefcase class="w-5 h-5" />
                    </a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#about" class="hover:text-primary transition">About Us</a></li>
                    <li><a href="#model" class="hover:text-primary transition">Our Model</a></li>
                    <li><a href="#impact" class="hover:text-primary transition">Impact</a></li>
                    <li><a href="#team" class="hover:text-primary transition">Our Team</a></li>
                    <li><a href="#partners" class="hover:text-primary transition">Partners</a></li>
                </ul>
            </div>

            <!-- Column 3: Programs -->
            <div>
                <h3 class="text-lg font-bold mb-4">Programs</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-primary transition">Seed Access & Multiplication</a></li>
                    <li><a href="#" class="hover:text-primary transition">Village Savings & Loans</a></li>
                    <li><a href="#" class="hover:text-primary transition">Value-Added Processing</a></li>
                    <li><a href="#" class="hover:text-primary transition">Climate-Smart Training</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact Us -->
            <div>
                <h3 class="text-lg font-bold mb-4">Contact Us</h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-map-pin class="w-5 h-5 flex-shrink-0 mt-0.5" />
                        <span>Likuni, Lilongwe, Malawi</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-envelope class="w-5 h-5 flex-shrink-0 mt-0.5" />
                        <a href="mailto:harvestglow@gmail.com" class="hover:text-primary transition">harvestglow@gmail.com</a>
                    </li>
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-phone class="w-5 h-5 flex-shrink-0 mt-0.5" />
                        <div>
                            <a href="tel:+265880856731" class="hover:text-primary transition block">+265 880 856 731</a>
                            <a href="tel:+265996084781" class="hover:text-primary transition block">+265 996 084 781</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
            <p>&copy; 2025 HarvestGlow. All rights reserved.</p>
        </div>
    </x-ui.container>
</footer>
