<x-layouts.auth.harvestglow title="Confirm Password" description="This is a secure area of the application. Please confirm your password before continuing.">
    <div class="space-y-6">

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
                <x-ui.loading-button type="submit" class="w-full" loadingText="Confirming...">
                    Confirm
                </x-ui.loading-button>
            </div>
        </form>
    </div>
</x-layouts.auth.harvestglow>
