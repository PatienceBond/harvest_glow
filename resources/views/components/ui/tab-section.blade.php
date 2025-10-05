@props([
    'id' => '',
    'title' => '',
    'icon' => ''
])

<div x-show="activeTab === '{{ $id }}'" x-transition class="mt-8">
    <div class="flex items-center gap-3 mb-6">
        @if($icon)
            <x-dynamic-component :component="$icon" class="w-10 h-10 text-primary" />
        @endif
        <h2 class="text-3xl font-bold">{{ $title }}</h2>
    </div>

    {{ $slot }}
</div>
