@props([
    'question' => '',
    'answer' => ''
])

<div {{ $attributes->merge(['class' => 'border-b border-border last:border-b-0']) }}>
    <button type="button" 
            @click="open = !open"
            class="w-full py-6 text-left flex justify-between items-center hover:text-primary transition-colors">
        <h3 class="text-lg font-semibold">{{ $question }}</h3>
        <x-heroicon-o-chevron-down 
            class="w-5 h-5 transform transition-transform duration-200"
            x-bind:class="{ 'rotate-180': open }" />
    </button>
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="pb-6">
        <p class="text-muted-foreground leading-relaxed">{{ $answer }}</p>
    </div>
</div>
