<?php

use Livewire\Volt\Component;

new class extends Component {
    public function saveTheme($theme)
    {
        session(['theme' => $theme]);
    }
}; ?>

<div x-data="{ isDark: {{ session('theme', 'light') === 'dark' ? 'true' : 'false' }} }">
    <button
        @click="
            isDark = !isDark;
            document.documentElement.classList.toggle('dark', isDark);
            $wire.saveTheme(isDark ? 'dark' : 'light');
        "
        class="p-2 text-foreground hover:opacity-80 transition-opacity"
  
    >
        <template x-if="isDark">
            <x-heroicon-o-sun class="w-5 h-5" />
        </template>
        <template x-if="!isDark">
            <x-heroicon-o-moon class="w-5 h-5" />
        </template>
    </button>
</div>
