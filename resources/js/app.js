import './bootstrap';

// Theme handling
document.addEventListener('livewire:init', () => {
    Livewire.on('theme-changed', (event) => {
        const theme = event.theme;
        document.documentElement.classList.toggle('dark', theme === 'dark');
        localStorage.setItem('theme', theme);
    });
});

// Initialize theme on page load
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.classList.toggle('dark', savedTheme === 'dark');
});

