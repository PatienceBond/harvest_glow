<!-- CTA Section -->
<section class="bg-primary py-16">
    <x-ui.container>
        <div class="text-center text-white">
            <h1 class="text-white text-3xl sm:text-4xl mb-6">Join Us in Transforming Agriculture in Malawi</h1>
            <p class="text-lg mb-8 max-w-4xl mx-auto">
                Every $1 invested in HarvestGlow is projected to generate $4 in community income, along with strengthened food security and climate resilience.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-ui.button-link href="{{ route('contact') }}" variant="card">
                    Invest in Our Work
                </x-ui.button-link>
                <x-ui.button-link href="{{ route('contact') }}" variant="outline-white">
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
                    <img src="{{ asset('logo/logo_icon.png') }}" alt="HarvestGlow" class="h-24 w-auto">
                </div>
                <p class="text-sm text-gray-300 mb-6">
                    Empowering farmers, building resilient communities in Malawi.
                </p>
               
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="{{ route('about') }}" class="hover:text-primary transition">About Us</a></li>
                    <li><a href="{{ route('our-model') }}" class="hover:text-primary transition">Our Model</a></li>
                    <li><a href="{{ route('impact') }}" class="hover:text-primary transition">Impact</a></li>
                    <li><a href="{{ route('team') }}" class="hover:text-primary transition">Our Team</a></li>
                    <li><a href="{{ route('partners') }}" class="hover:text-primary transition">Partners</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Contact Us</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-primary transition">Admin</a></li>
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
                        <a href="mailto:harvestglow@gmail.com" class="hover:text-primary transition">info@harvestglow.org</a>
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

        <!-- Footer Bottom -->
        <div class="border-t border-gray-700 pt-6 text-sm text-gray-400">
            <div class="flex flex-col items-center sm:items-end gap-4">
                <div class="flex items-center gap-4">
                    <a href="https://www.facebook.com/profile.php?id=61581821352646" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                            <path d="M22 12.073C22 6.477 17.523 2 11.927 2 6.33 2 1.853 6.477 1.853 12.073c0 4.99 3.657 9.128 8.438 9.878v-6.987H7.898v-2.89h2.393V9.845c0-2.367 1.41-3.677 3.562-3.677 1.032 0 2.112.184 2.112.184v2.326h-1.19c-1.174 0-1.54.728-1.54 1.476v1.773h2.623l-.419 2.89h-2.204V22c4.78-.75 8.437-4.888 8.437-9.927z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/harvestglow/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                            <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4v16h-4V8zm7.5 0h3.8v2.2h.1c.5-1 1.7-2.2 3.6-2.2 3.8 0 4.5 2.5 4.5 5.7V24h-4v-7.6c0-1.8 0-4.1-2.5-4.1-2.5 0-2.9 1.9-2.9 3.9V24h-4V8z"/>
                        </svg>
                    </a>
                </div>
                <p class="text-center sm:text-right">&copy; 2025 HarvestGlow. All rights reserved.</p>
            </div>
        </div>
    </x-ui.container>
</footer>
