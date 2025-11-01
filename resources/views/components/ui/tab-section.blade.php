@props([
    'id' => '',
    'title' => '',
    'icon' => '',
    'alwaysVisible' => false,
])

<div @if(!$alwaysVisible) x-show="activeTab === '{{ $id }}'" x-transition @endif class="mt-8">
    <div class="flex items-center gap-3 mb-6">
        @if($icon)
            <x-dynamic-component :component="$icon" class="w-10 h-10 text-primary" />
        @endif
        <h2 class="text-3xl md:text-4xl font-bold">{{ $title }}</h2>
    </div>

    {{ $slot }}
</div>
