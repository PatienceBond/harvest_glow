@props([
    'accept' => 'image/*',
    'maxSize' => '2048', // KB
    'wireModel' => '',
    'existingImage' => null,
    'preview' => true,
    'previewClass' => 'w-full h-48 object-cover rounded-lg border border-border',
    'placeholder' => 'Click to upload or drag and drop'
])

<div x-data="{
    preview: '{{ $existingImage ? (str_starts_with($existingImage, 'http') ? $existingImage : Storage::url($existingImage)) : '' }}',
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
class="space-y-4">
    
    <!-- Image Preview (if exists) -->
    <div x-show="preview" x-transition class="relative">
        <img :src="preview" alt="Preview" class="{{ $previewClass }}">
        <button type="button" 
                @click.prevent="preview = ''; $refs.fileInput.value = ''; $wire.set('{{ $wireModel }}', null)"
                class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 shadow-lg transition-colors">
            <x-heroicon-o-x-mark class="w-4 h-4" />
        </button>
    </div>

    <!-- File Input -->
    <div class="relative">
        <input type="file" 
               wire:model="{{ $wireModel }}"
               x-ref="fileInput"
               @change="handleFiles($event.target.files)"
               accept="{{ $accept }}"
               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
               id="{{ $wireModel }}">
        <label for="{{ $wireModel }}" 
               :class="isDragging ? 'border-primary bg-primary/5' : 'border-border'"
               class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer hover:bg-muted/50 transition-colors">
            <div class="flex flex-col items-center justify-center pt-5 pb-6 pointer-events-none">
                <x-heroicon-o-cloud-arrow-up class="w-8 h-8 mb-2 text-muted-foreground" />
                <p class="mb-2 text-sm text-muted-foreground">
                    <span class="font-semibold">{{ $placeholder }}</span>
                </p>
                <p class="text-xs text-muted-foreground">
                    {{ $accept === 'image/*' ? 'PNG, JPG, GIF up to ' . $maxSize . 'KB' : 'Files up to ' . $maxSize . 'KB' }}
                </p>
            </div>
        </label>
    </div>

    <!-- Upload Progress -->
    <div wire:loading wire:target="{{ $wireModel }}" class="text-center">
        <div class="inline-flex items-center px-4 py-2 text-sm text-muted-foreground">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Uploading...
        </div>
    </div>

    <!-- Error Messages -->
    @error($wireModel)
        <div class="text-sm text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>
