<?php

use Livewire\Volt\Component;

new class extends Component {
    public $isDark = false;

    public function mount()
    {
        $this->isDark = session('theme', 'light') === 'dark';
    }

    public function toggle()
    {
        $this->isDark = !$this->isDark;
        session(['theme' => $this->isDark ? 'dark' : 'light']);
        
        $this->dispatch('theme-changed', theme: $this->isDark ? 'dark' : 'light');
    }
}; ?>

<div>
    <button 
        wire:click="toggle"
        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200"
        title="{{ $isDark ? 'Switch to light mode' : 'Switch to dark mode' }}"
    >
        @if($isDark)
            <x-heroicon-o-sun class="w-5 h-5" />
        @else
            <x-heroicon-o-moon class="w-5 h-5" />
        @endif
    </button>
</div>
