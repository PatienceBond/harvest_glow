@props([
    'title' => '',
    'description' => ''
])

<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-foreground">{{ $title }}</h1>
        @if($description)
            <p class="mt-2 text-muted-foreground">
                {{ $description }}
            </p>
        @endif
    </div>
    
    @if(isset($actions))
        <div class="mt-4 sm:mt-0">
            {{ $actions }}
        </div>
    @endif
</div>

