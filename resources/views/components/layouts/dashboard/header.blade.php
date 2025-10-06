@props(['title' => ''])

<header class="sticky top-0 z-30 bg-background border-b border-border">
    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
        <!-- Left: Page Title and Mobile Menu -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Button -->
            <button @click="sidebarOpen = true"
                    class="md:hidden -ml-2 p-2 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted">
                <x-heroicon-o-bars-3 class="h-6 w-6" />
            </button>

            <!-- Page Title -->
            @if($title || $slot->isNotEmpty())
                <div>
                    @if($title)
                        <h1 class="text-2xl font-bold text-foreground">{{ $title }}</h1>
                    @endif
                    {{ $slot }}
                </div>
            @endif
        </div>

        <!-- Right: Theme Toggle, User Menu -->
        <div class="flex items-center space-x-3">
            <!-- Theme Toggle -->
            <livewire:theme-toggle />

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                        @click.away="open = false"
                        class="flex items-center space-x-3 p-2 rounded-lg hover:bg-muted transition-colors">
                    <div class="flex items-center space-x-3">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-medium text-foreground">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-muted-foreground">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="h-9 w-9 bg-primary/10 rounded-full flex items-center justify-center ring-2 ring-primary/20">
                            <x-heroicon-o-user class="h-5 w-5 text-primary" />
                        </div>
                    </div>
                    <x-heroicon-o-chevron-down class="h-4 w-4 text-muted-foreground" x-bind:class="{ 'rotate-180': open }" />
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-56 origin-top-right rounded-lg bg-card border border-border shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                     style="display: none;">
                    <div class="py-1">
                        <!-- User Info (Mobile Only) -->
                        <div class="sm:hidden px-4 py-3 border-b border-border">
                            <p class="text-sm font-medium text-foreground">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-muted-foreground">{{ auth()->user()->email }}</p>
                        </div>

                        <!-- Profile Link -->
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center px-4 py-2 text-sm text-foreground hover:bg-muted transition-colors">
                            <x-heroicon-o-user-circle class="mr-3 h-5 w-5 text-muted-foreground" />
                            Profile Settings
                        </a>

                        <!-- Settings -->
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center px-4 py-2 text-sm text-foreground hover:bg-muted transition-colors">
                            <x-heroicon-o-cog-6-tooth class="mr-3 h-5 w-5 text-muted-foreground" />
                            Account Settings
                        </a>

                        <div class="border-t border-border my-1"></div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center w-full px-4 py-2 text-sm text-destructive hover:bg-destructive/10 transition-colors">
                                <x-heroicon-o-arrow-right-on-rectangle class="mr-3 h-5 w-5" />
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
