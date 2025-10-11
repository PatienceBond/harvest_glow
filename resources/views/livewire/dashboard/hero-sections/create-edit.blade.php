<flux:modal name="hero-form" class="min-w-[600px]">
    <div>
        <div class="py-4">
            <h3 class="text-lg font-semibold text-foreground">
                {{ $heroId ? 'Edit Hero Section' : 'Add New Hero Section' }}
            </h3>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Page -->
            <flux:select wire:model="page" label="Page" required :disabled="$heroId ? true : false">
                <option value="">Select Page</option>
                <option value="home">Home</option>
                <option value="about">About</option>
                <option value="our-model">Our Model</option>
                <option value="impact">Impact</option>
                <option value="team">Team</option>
                <option value="partners">Partners</option>
                <option value="contact">Contact</option>
            </flux:select>

            @if($heroId)
                <div class="text-xs text-muted-foreground">
                    Note: Page cannot be changed after creation. Delete and recreate if needed.
                </div>
            @endif

            <!-- Heading -->
            <flux:input 
                wire:model="heading"
                label="Heading"
                placeholder="e.g., Empowering Farmers, Building Futures"
                required
            />

            <!-- Subheading -->
            <flux:textarea 
                wire:model="subheading"
                label="Subheading (Optional)"
                placeholder="Optional tagline or description"
                rows="2"
            />

            <!-- Image Upload (Single - for non-landing pages) -->
            @if($page !== 'home')
                <div>
                    <flux:label>Hero Image</flux:label>
                    <p class="text-xs text-muted-foreground mb-2">Images will be optimized to 1920x1080px WebP format</p>
                    <x-ui.file-upload
                        wireModel="image"
                        :existingImage="$existing_image"
                        accept="image/*"
                        maxSize="3072"
                        placeholder="Upload hero image"
                    />
                </div>
            @endif

            <!-- Multiple Slider Images (for home page only) -->
            @if($page === 'home')
                <div class="space-y-4">
                    <div>
                        <flux:label>Slider Images (Multiple)</flux:label>
                        <p class="text-xs text-muted-foreground mb-2">Upload 4-6 images for the slider. Images will be optimized to 1920x1080px WebP format</p>
                    </div>

                    <!-- Existing Slider Images -->
                    @if(!empty($existingSliderImages))
                        <div class="space-y-2">
                            <p class="text-sm font-medium">Current Slider Images:</p>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($existingSliderImages as $sliderImg)
                                    <div class="relative group">
                                        <img src="{{ Storage::url($sliderImg['image_path']) }}" 
                                             alt="Slider image"
                                             class="w-full h-32 object-cover rounded-lg border border-border">
                                        <button type="button"
                                                wire:click="deleteSliderImage({{ $sliderImg['id'] }})"
                                                wire:confirm="Delete this slider image?"
                                                class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <x-heroicon-o-x-mark class="w-3 h-3" />
                                        </button>
                                        <span class="absolute bottom-1 left-1 bg-black/60 text-white text-xs px-2 py-1 rounded">
                                            Order: {{ $sliderImg['order'] }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Slider Images -->
                    <div>
                        <input type="file"
                               wire:model="sliderImages"
                               accept="image/*"
                               multiple
                               class="block w-full text-sm text-foreground file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90 border border-border rounded-lg cursor-pointer">
                        <p class="text-xs text-muted-foreground mt-1">Select multiple images (hold Ctrl/Cmd to select multiple)</p>
                        
                        <div wire:loading wire:target="sliderImages" class="mt-2 text-sm text-primary">
                            Uploading images...
                        </div>

                        @error('sliderImages.*')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview of newly selected images -->
                    @if($sliderImages && count($sliderImages) > 0)
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-green-600">New images to upload ({{ count($sliderImages) }}):</p>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($sliderImages as $index => $img)
                                    @if($img)
                                        <div class="relative">
                                            <img src="{{ $img->temporaryUrl() }}" 
                                                 alt="Preview"
                                                 class="w-full h-32 object-cover rounded-lg border-2 border-green-500">
                                            <span class="absolute bottom-1 left-1 bg-green-600 text-white text-xs px-2 py-1 rounded">
                                                New
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Height -->
            <flux:select wire:model="height" label="Height" required>
                <option value="400px">Small (400px)</option>
                <option value="500px">Medium (500px)</option>
                <option value="600px">Large (600px)</option>
                <option value="700px">Extra Large (700px)</option>
                <option value="100vh">Full Screen (100vh)</option>
            </flux:select>

            <!-- Active Status -->
            <flux:checkbox 
                wire:model="is_active"
                label="Active (Show on website)"
            />

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
                <flux:modal.close>
                    <flux:button variant="filled">Cancel</flux:button>
                </flux:modal.close>
                <flux:button 
                    type="submit" 
                    variant="primary"
                >
                    <span wire:loading.remove wire:target="save">
                        {{ $heroId ? 'Update Hero' : 'Add Hero' }}
                    </span>
                    <span wire:loading wire:target="save">
                        {{ $heroId ? 'Updating...' : 'Adding...' }}
                    </span>
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('create-hero', () => {
            window.Flux.modal('hero-form').show();
        });

        Livewire.on('edit-hero', () => {
            window.Flux.modal('hero-form').show();
        });

        Livewire.on('hero-saved', () => {
            window.Flux.modal('hero-form').close();
        });
    });
</script>

