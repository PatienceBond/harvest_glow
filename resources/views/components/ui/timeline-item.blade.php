@props([
    'phase' => '',
    'title' => '',
    'items' => []
])

<div class="flex gap-6">
    <!-- Phase Number -->
    <div class="flex-shrink-0">
        <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-xl font-bold">
            {{ $phase }}
        </div>
    </div>

    <!-- Content -->
    <div class="flex-1 pb-12">
        <h3 class="text-2xl font-bold mb-4">{{ $title }}</h3>
        <ul class="space-y-2">
            @foreach($items as $item)
                <li class="flex items-start gap-2">
                    <x-heroicon-o-arrow-right class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" />
                    <span>{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
