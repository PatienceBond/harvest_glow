@props([
    'title' => '',
    'description' => ''
])

<section {{ $attributes }}>
    <x-ui.container>
        <div class="text-center mb-12">
            <h1 class="inline-block bg-primary text-white px-6 py-2 rounded-lg mb-4 text-xl sm:text-2xl">{{ $title }}</h1>
            <p class="text-lg text-muted-foreground max-w-4xl mx-auto">
                {{ $description }}
            </p>
        </div>

        <!-- Feature Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{ $slot }}
        </div>
    </x-ui.container>
</section>
