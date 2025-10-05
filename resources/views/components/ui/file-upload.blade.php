@props([
    'accept' => 'image/*',
    'maxSize' => '2048', // KB
    'wireModel' => '',
    'preview' => true,
    'previewClass' => 'w-full h-48 object-cover rounded-lg border border-border',
    'placeholder' => 'Click to upload or drag and drop'
])

<div class="space-y-4">
    <!-- File Input -->
    <div class="relative">
        <input type="file" 
               wire:model="{{ $wireModel }}"
               accept="{{ $accept }}"
               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
               id="{{ $wireModel }}">
        <label for="{{ $wireModel }}" 
               class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-border rounded-lg cursor-pointer hover:bg-muted/50 transition-colors">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
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
    @if($wireModel && $errors->has($wireModel))
        <div class="text-sm text-destructive">
            {{ $errors->first($wireModel) }}
        </div>
    @endif

    <!-- File Preview -->
    @if($preview && $wireModel)
        <div wire:loading wire:target="{{ $wireModel }}" class="text-center">
            <div class="inline-flex items-center px-4 py-2 text-sm text-muted-foreground">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Uploading...
            </div>
        </div>

        @if($this->getPropertyValue($wireModel))
            <div class="relative">
                @php
                    $fileValue = $this->getPropertyValue($wireModel);
                @endphp
                
                @if(is_object($fileValue) && method_exists($fileValue, 'temporaryUrl'))
                    {{-- Livewire file upload object --}}
                    <img src="{{ $fileValue->temporaryUrl() }}" alt="Preview" class="{{ $previewClass }}">
                @elseif(is_string($fileValue) && (str_starts_with($fileValue, 'data:image') || 
                    str_contains($fileValue, 'storage/') ||
                    str_contains($fileValue, 'images/')))
                    {{-- Existing file path --}}
                    <img src="{{ $fileValue }}" alt="Preview" class="{{ $previewClass }}">
                @elseif(is_string($fileValue))
                    {{-- Other file types --}}
                    <div class="flex items-center justify-center w-full h-32 bg-muted rounded-lg border border-border">
                        <div class="text-center">
                            <x-heroicon-o-document class="w-8 h-8 mx-auto text-muted-foreground mb-2" />
                            <p class="text-sm text-muted-foreground">{{ basename($fileValue) }}</p>
                        </div>
                    </div>
                @endif
                
                <button type="button" 
                        wire:click="removeFile('{{ $wireModel }}')"
                        class="absolute top-2 right-2 bg-background/80 hover:bg-background text-foreground rounded-full p-1 shadow-sm">
                    <x-heroicon-o-x-mark class="w-4 h-4" />
                </button>
            </div>
        @endif
    @endif
</div>
