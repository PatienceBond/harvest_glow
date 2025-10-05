@props([
    'color' => 'rgb(59, 130, 246)', // blue-500
    'height' => '3px',
    'speed' => '400',
    'showSpinner' => true,
    'livewire' => true
])

<div id="advanced-top-loader" class="fixed top-0 left-0 w-full z-[9999] pointer-events-none" style="display: none;">
    <!-- Progress Bar -->
    <div 
        id="advanced-top-loader-bar" 
        class="transition-all ease-out duration-150"
        style="
            height: {{ $height }};
            background: linear-gradient(90deg, {{ $color }}, {{ $color }}88);
            box-shadow: 0 0 10px {{ $color }}, 0 0 5px {{ $color }};
            transform: translateX(-100%);
            width: 100%;
            position: relative;
            overflow: hidden;
        "
    >
        <!-- Animated shimmer effect -->
        <div 
            class="absolute inset-0 opacity-30"
            style="
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
                animation: shimmer 2s infinite;
            "
        ></div>
    </div>
    
    <!-- Spinner (optional) -->
    @if($showSpinner)
        <div 
            id="advanced-top-loader-spinner" 
            class="fixed top-4 right-4 w-6 h-6 border-2 border-transparent border-t-current rounded-full animate-spin"
            style="color: {{ $color }}; display: none;"
        ></div>
    @endif
</div>

<style>
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Smooth transitions */
#advanced-top-loader {
    transition: opacity 0.3s ease;
}

#advanced-top-loader-bar {
    transition: transform 0.3s ease, opacity 0.3s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById('advanced-top-loader');
    const loaderBar = document.getElementById('advanced-top-loader-bar');
    const loaderSpinner = document.getElementById('advanced-top-loader-spinner');
    
    let progress = 0;
    let timer = null;
    let isVisible = false;
    let startTime = null;
    
    // Configuration
    const config = {
        minProgress: 10,
        maxProgress: 90,
        incrementSpeed: 15,
        updateInterval: 100,
        hideDelay: 300,
        color: '{{ $color }}',
        speed: {{ $speed }}
    };
    
    // Show loader with animation
    function showLoader() {
        if (isVisible) return;
        
        isVisible = true;
        startTime = Date.now();
        
        // Fade in loader
        loader.style.opacity = '0';
        loader.style.display = 'block';
        if (loaderSpinner) loaderSpinner.style.display = 'block';
        
        // Animate opacity
        requestAnimationFrame(() => {
            loader.style.opacity = '1';
        });
        
        // Reset progress
        progress = 0;
        loaderBar.style.transform = 'translateX(-100%)';
        
        // Simulate realistic progress
        timer = setInterval(() => {
            const elapsed = Date.now() - startTime;
            const baseProgress = Math.min(elapsed / (config.speed * 10), 0.7); // 70% max from time
            const randomIncrement = Math.random() * config.incrementSpeed;
            
            progress = Math.min(baseProgress * 100 + randomIncrement, config.maxProgress);
            
            if (progress > config.maxProgress) {
                progress = config.maxProgress;
            }
            
            loaderBar.style.transform = `translateX(-${100 - progress}%)`;
        }, config.updateInterval);
    }
    
    // Hide loader with smooth animation
    function hideLoader() {
        if (!isVisible) return;
        
        isVisible = false;
        clearInterval(timer);
        
        // Complete the progress bar
        progress = 100;
        loaderBar.style.transform = 'translateX(0%)';
        
        // Fade out after completion
        setTimeout(() => {
            loader.style.opacity = '0';
            if (loaderSpinner) loaderSpinner.style.display = 'none';
            
            setTimeout(() => {
                loader.style.display = 'none';
                loaderBar.style.transform = 'translateX(-100%)';
            }, config.hideDelay);
        }, 200);
    }
    
    // Livewire events
    @if($livewire)
    document.addEventListener('livewire:navigating', showLoader);
    document.addEventListener('livewire:navigated', hideLoader);
    document.addEventListener('livewire:load', hideLoader);
    
    // Livewire form submissions
    document.addEventListener('livewire:submit', showLoader);
    document.addEventListener('livewire:submitted', hideLoader);
    @endif
    
    // Form submissions
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.matches('form[wire\\:submit]') || 
            form.matches('form[wire\\:submit\\.prevent]') ||
            form.querySelector('[wire\\:click]')) {
            showLoader();
        }
    });
    
    // Navigation links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[href]');
        if (link && link.href && !link.href.startsWith('#') && 
            !link.href.startsWith('javascript:') && 
            !link.href.startsWith('mailto:') &&
            !link.href.startsWith('tel:')) {
            
            // Check if it's an internal link
            try {
                const url = new URL(link.href);
                if (url.hostname === window.location.hostname && 
                    url.pathname !== window.location.pathname) {
                    showLoader();
                }
            } catch (error) {
                // Invalid URL, ignore
            }
        }
    });
    
    // AJAX requests
    const originalFetch = window.fetch;
    window.fetch = function(...args) {
        // Only show loader for non-GET requests or important requests
        const url = args[0];
        const options = args[1] || {};
        
        if (options.method && options.method !== 'GET') {
            showLoader();
            return originalFetch.apply(this, args)
                .finally(() => {
                    setTimeout(hideLoader, config.hideDelay);
                });
        }
        
        return originalFetch.apply(this, args);
    };
    
    // Page load complete
    window.addEventListener('load', function() {
        setTimeout(hideLoader, 500);
    });
    
    // Handle page visibility changes
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            hideLoader();
        }
    });
    
    // Handle browser back/forward
    window.addEventListener('popstate', showLoader);
    
    // Handle errors
    window.addEventListener('error', function() {
        setTimeout(hideLoader, 1000);
    });
    
    // Expose functions globally for manual control
    window.AdvancedTopLoader = {
        show: showLoader,
        hide: hideLoader,
        config: config
    };
    
    // Initialize - hide loader on page load
    hideLoader();
});
</script>
