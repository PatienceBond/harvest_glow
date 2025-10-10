@props([
    'wireModel' => 'photo',
    'existingImage' => null,
    'label' => 'Profile Photo',
    'helpText' => 'Upload a profile photo (Max 1MB, JPG, PNG)',
    'required' => false
])

<div {{ $attributes->merge(['class' => 'space-y-3']) }}>
    <label class="block text-sm font-medium text-foreground">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    
    @if($helpText)
        <p class="text-xs text-muted-foreground">{{ $helpText }}</p>
    @endif

    <div 
        x-data="{ 
            preview: '{{ $existingImage ? Storage::url($existingImage) : '' }}',
            isDragging: false,
            handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.preview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        }"
        @drop.prevent="isDragging = false; handleFiles($event.dataTransfer.files); $refs.fileInput.files = $event.dataTransfer.files; $wire.upload('{{ $wireModel }}', $refs.fileInput.files[0])"
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        class="flex items-center gap-6"
    >
        <!-- Avatar Preview -->
        <div class="relative">
            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-border bg-muted flex items-center justify-center">
                <template x-if="preview">
                    <img 
                        :src="preview" 
                        alt="Preview" 
                        class="w-full h-full object-cover"
                    >
                </template>
                <template x-if="!preview">
                    <svg class="w-16 h-16 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </template>
            </div>
            
            <!-- Remove button (only show if there's a preview) -->
            <button 
                type="button"
                x-show="preview"
                @click="preview = null; $refs.fileInput.value = ''; $wire.set('{{ $wireModel }}', null)"
                class="absolute -top-2 -right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors shadow-lg"
                title="Remove image"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Upload Button -->
        <div class="flex-1">
            <div 
                :class="isDragging ? 'border-primary bg-primary/5' : 'border-border'"
                class="relative border-2 border-dashed rounded-lg p-4 transition-colors duration-200 hover:border-primary/50 hover:bg-muted/50"
            >
                <input 
                    type="file" 
                    wire:model="{{ $wireModel }}"
                    x-ref="fileInput"
                    @change="handleFiles($event.target.files)"
                    accept="image/jpeg,image/png,image/jpg"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                >
                
                <div class="text-center">
                    <svg class="mx-auto h-8 w-8 text-muted-foreground" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="mt-2">
                        <span class="text-xs font-medium text-primary">Click to upload</span>
                        <span class="text-xs text-muted-foreground"> or drag and drop</span>
                    </div>
                    <p class="text-xs text-muted-foreground mt-1">Square image recommended</p>
                </div>
            </div>

            <!-- Loading State -->
            <div wire:loading wire:target="{{ $wireModel }}" class="mt-2">
                <div class="flex items-center gap-2 text-xs text-primary">
                    <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Uploading...</span>
                </div>
            </div>
        </div>
    </div>

    @error($wireModel)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

