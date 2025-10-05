@props([
    'color' => '#3b82f6', // blue-500
    'height' => '3px',
    'speed' => '400',
    'showSpinner' => true
])

<div id="top-loader" class="fixed top-0 left-0 w-full z-[9999] pointer-events-none hidden">
    <!-- Progress Bar -->
    <div 
        id="top-loader-bar" 
        class="top-loader-bar transition-all ease-out duration-150"
        data-color="{{ $color }}"
        data-height="{{ $height }}"
    ></div>
    
    <!-- Spinner (optional) -->
    @if($showSpinner)
        <div 
            id="top-loader-spinner" 
            class="fixed top-4 right-4 w-6 h-6 border-2 border-transparent border-t-current rounded-full animate-spin hidden"
            data-color="{{ $color }}"
        ></div>
    @endif
</div>

<style>
.top-loader-bar {
    transform: translateX(-100%);
    width: 100%;
}

#top-loader {
    transition: opacity 0.3s ease;
}

#top-loader-bar {
    transition: transform 0.3s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById('top-loader');
    const loaderBar = document.getElementById('top-loader-bar');
    const loaderSpinner = document.getElementById('top-loader-spinner');
    
    // Get configuration from data attributes
    const color = loaderBar.dataset.color || '#3b82f6';
    const height = loaderBar.dataset.height || '3px';
    
    // Apply styles
    loaderBar.style.backgroundColor = color;
    loaderBar.style.height = height;
    if (loaderSpinner) {
        loaderSpinner.style.color = color;
    }
    
    let progress = 0;
    let timer = null;
    let isVisible = false;
    
    // Show loader
    function showLoader() {
        if (isVisible) return;
        
        isVisible = true;
        loader.classList.remove('hidden');
        loader.classList.add('block');
        if (loaderSpinner) {
            loaderSpinner.classList.remove('hidden');
            loaderSpinner.classList.add('block');
        }
        
        progress = 0;
        loaderBar.style.transform = 'translateX(-100%)';
        
        // Simulate progress
        timer = setInterval(function() {
            progress += Math.random() * 15;
            if (progress > 90) {
                progress = 90;
                clearInterval(timer);
            }
            loaderBar.style.transform = 'translateX(-' + (100 - progress) + '%)';
        }, 100);
    }
    
    // Hide loader
    function hideLoader() {
        if (!isVisible) return;
        
        isVisible = false;
        progress = 100;
        loaderBar.style.transform = 'translateX(0%)';
        
        setTimeout(function() {
            loader.classList.add('hidden');
            loader.classList.remove('block');
            if (loaderSpinner) {
                loaderSpinner.classList.add('hidden');
                loaderSpinner.classList.remove('block');
            }
            loaderBar.style.transform = 'translateX(-100%)';
        }, 300);
    }
    
    // Livewire navigation events
    document.addEventListener('livewire:navigating', showLoader);
    document.addEventListener('livewire:navigated', hideLoader);
    
    // Form submissions
    document.addEventListener('submit', function(e) {
        if (e.target.matches('form[wire\\:submit]') || e.target.matches('form[wire\\:submit\\.prevent]')) {
            showLoader();
        }
    });
    
    // Link clicks (for navigation)
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[href]');
        if (link && link.href && !link.href.startsWith('#') && !link.href.startsWith('javascript:')) {
            try {
                const url = new URL(link.href);
                if (url.hostname === window.location.hostname) {
                    showLoader();
                }
            } catch (error) {
                // Invalid URL, ignore
            }
        }
    });
    
    // AJAX requests
    const originalFetch = window.fetch;
    window.fetch = function() {
        showLoader();
        return originalFetch.apply(this, arguments)
            .finally(function() {
                setTimeout(hideLoader, 500);
            });
    };
    
    // Page load complete
    window.addEventListener('load', hideLoader);
    
    // Handle page visibility changes
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            hideLoader();
        }
    });
    
    // Expose functions globally for manual control
    window.TopLoader = {
        show: showLoader,
        hide: hideLoader
    };
});
</script>