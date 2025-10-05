<div>
    <x-ui.container>
        <div class="py-12">
            <h1 class="text-4xl font-bold text-center mb-8">Top Loader Demo</h1>
            
            <div class="max-w-2xl mx-auto space-y-6">
                <div class="bg-card border border-border rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">Test the Top Loader</h2>
                    <p class="text-muted-foreground mb-6">
                        Click the buttons below to test different loader scenarios:
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Manual Control Buttons -->
                        <button 
                            onclick="window.TopLoader.show()" 
                            class="bg-primary text-white py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors font-medium"
                        >
                            Show Loader
                        </button>
                        
                        <button 
                            onclick="window.TopLoader.hide()" 
                            class="bg-secondary text-secondary-foreground py-3 px-4 rounded-lg hover:bg-secondary/90 transition-colors font-medium"
                        >
                            Hide Loader
                        </button>
                        
                        <!-- Navigation Links -->
                        <a 
                            href="{{ route('home') }}" 
                            class="bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition-colors font-medium text-center"
                        >
                            Navigate to Home
                        </a>
                        
                        <a 
                            href="{{ route('about') }}" 
                            class="bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium text-center"
                        >
                            Navigate to About
                        </a>
                        
                        <!-- Form Test -->
                        <div class="md:col-span-2">
                            <form wire:submit="testForm" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Test Form</label>
                                    <input 
                                        type="text" 
                                        placeholder="Enter some text..."
                                        class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    >
                                </div>
                                <button 
                                    type="submit" 
                                    class="w-full bg-orange-600 text-white py-3 px-4 rounded-lg hover:bg-orange-700 transition-colors font-medium"
                                >
                                    Submit Form (Livewire)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="bg-muted/30 border border-border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-3">Loader Features:</h3>
                    <ul class="space-y-2 text-sm text-muted-foreground">
                        <li>• Shows on Livewire navigation</li>
                        <li>• Shows on form submissions</li>
                        <li>• Shows on internal link clicks</li>
                        <li>• Shows on AJAX requests</li>
                        <li>• Automatic progress simulation</li>
                        <li>• Smooth animations</li>
                        <li>• Manual control via JavaScript</li>
                    </ul>
                </div>
            </div>
        </div>
    </x-ui.container>
</div>
