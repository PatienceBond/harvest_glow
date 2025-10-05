<x-layouts.auth.harvestglow>
    <div class="text-center space-y-6">
        <div>
            <x-heroicon-o-lock-closed class="w-16 h-16 text-primary mx-auto mb-4" />
            <h2 class="text-2xl font-bold text-foreground mb-2">Confirm Password</h2>
            <p class="text-muted-foreground">
                This is a secure area of the application. Please confirm your password before continuing.
            </p>
        </div>

        @if (session('status'))
            <div class="p-4 bg-success/10 border border-success/20 rounded-lg text-success text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="password" class="block text-sm font-medium mb-2">Password</label>
                <input 
                    name="password"
                    id="password" 
                    type="password" 
                    required 
                    autocomplete="current-password"
                    class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Enter your password"
                >
            </div>

            <div>
                <button type="submit" class="w-full bg-primary text-white py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors font-medium">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</x-layouts.auth.harvestglow>
