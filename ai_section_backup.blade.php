<!-- AI-Powered Agricultural Innovation -->
<section id="ai-innovation" class="py-4.5 bg-white relative">
    <style>
        .ai-card {
            position: relative;
            z-index: 20;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(154, 199, 171, 0.3), 0 2px 4px -1px rgba(154, 199, 171, 0.2);
        }
        
        .ai-card:hover {
            transform: scale(0.98) translateY(-3px);
            box-shadow: 0 6px 8px -1px rgba(154, 199, 171, 0.4), 0 4px 6px -1px rgba(154, 199, 171, 0.3);
        }
        
        .icon-bg {
            background-color: #f9fafb !important;
        }
        
        /* Connection lines */
        .connection-lines {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }
        
        .connection-line {
            position: absolute;
            background: #3b82f6;
            height: 2px;
            transform-origin: left center;
            z-index: 0;
            opacity: 0;
            animation: drawLine 0.5s forwards;
        }
        
        .connection-line::after {
            content: '';
            position: absolute;
            right: -5px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-bottom: 5px solid transparent;
            border-left: 8px solid #527f63;
        }
        
        @keyframes drawLine {
            from { width: 0; opacity: 0; }
            to { width: var(--line-length); opacity: 0.6; }
        }
        
        /* Connection lines container */
        .connection-lines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 5;
            overflow: visible;
        }
        
        /* Individual line styling */
        .connection-line {
            position: absolute;
            background: #527f63;
            height: 2px;
            transform-origin: left center;
            z-index: 5;
            opacity: 0.6;
            overflow: visible;
            pointer-events: none;
            will-change: transform, opacity;
        }
        
        .connection-line::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.9),
                rgba(255, 255, 255, 0.7),
                transparent);
            animation: flow 2s linear infinite;
            transform: translateX(-100%);
            opacity: 0.8;
        }
        
        @keyframes flow {
            0% { 
                transform: translateX(-100%) scaleX(1);
                opacity: 0.8;
            }
            50% {
                opacity: 1;
            }
            100% { 
                transform: translateX(calc(100% + var(--line-length))) scaleX(1.5);
                opacity: 0.8;
            }
        }
        
        /* Arrow head */
        .connection-line::after {
            content: '';
            position: absolute;
            right: -5px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-bottom: 5px solid transparent;
            border-left: 8px solid #527f63;
        }
        
        /* Hide on mobile */
        @media (max-width: 768px) {
            .connection-lines, .connection-line {
                display: none;
            }
        }
    </style>
    <x-ui.container>
        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-3 mb-4">
                <img src="{{ asset('logo/logo_icon.png') }}" alt="Logo" class="h-8 w-auto">
                <h1 class="text-4xl font-bold">AI-Powered Agricultural Innovation</h1>
            </div>
            <p class="text-lg text-muted-foreground max-w-3xl mx-auto">Empowering Farmers Through Data, Technology & Local Value Creation</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            <!-- Smart Seed Systems -->
            <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-1" style="min-height: 280px;">
                <div class="p-3 flex flex-col h-full">
                    <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                        <img src="{{ asset('logo/icons/sprout.png') }}" alt="Smart Seed Systems" class="w-8 h-8 object-contain">
                    </div>
                    <h3 class="text-xlg font-bold text-center mb-2">Smart Seed Systems</h3>
                    <p class="text-muted-foreground text-center mb-3 text-base">Predictive analytics for drought & pest resistance</p>
                    <div class="mt-auto">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                            <p class="text-sm font-medium">Reliable access to quality, climate-resilient seeds</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial & Gender Inclusion | Smart Lending -->
            <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-2" style="min-height: 280px;">
                <div class="p-3 flex flex-col h-full">
                    <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                        <img src="{{ asset('logo/icons/financial-inclusion.png') }}" alt="Financial & Gender Inclusion" class="w-8 h-8 object-contain">
                    </div>
                    <h3 class="text-xlg font-bold text-center mb-2">Financial & Gender Inclusion</h3>
                    <p class="text-muted-foreground text-center mb-3 text-base">Access to finance through AI-driven credit scoring from cooperative and yield data</p>
                    <div class="mt-auto">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                            <p class="text-sm font-medium">Inclusive finance for women and smallholders.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Value Addition & Processing -->
            <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-3" style="min-height: 280px;">
                <div class="p-3 flex flex-col h-full">
                    <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                        <img src="{{ asset('logo/icons/supply-chain.png') }}" alt="Value Addition" class="w-8 h-8 object-contain">
                    </div>
                    <h3 class="text-xlg font-bold text-center mb-2">Value Addition & Processing</h3>
                    <p class="text-muted-foreground text-center mb-3 text-base">AI quality monitoring via imaging & sensors</p>
                    <div class="mt-auto">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                            <p class="text-sm font-medium">Increased incomes, reduced post-harvest loss</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Digital Climate Intelligence -->
            <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" style="min-height: 240px;">
                <div class="p-3 flex flex-col h-full">
                    <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center shadow-md mx-auto mb-3 overflow-hidden">
                        <img src="{{ asset('logo/dzuwa.png') }}" alt="Climate Intelligence" class="w-10 h-10 object-contain">
                    </div>
                    <h3 class="text-xlg font-bold text-center mb-2">Digital Climate Intelligence</h3>
                    <p class="text-muted-foreground text-center mb-3 text-base">Satellite data, IoT & ML for advisory</p>
                    <div class="mt-auto">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-500 mb-1">Outcome</p>
                            <p class="text-sm font-medium">Resilient farms and adaptive practices</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technology-based -->
            <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border-2 border-primary h-full flex flex-col relative z-10 w-80" id="tech-hub" style="min-height: 240px;">
                <div class="p-3 flex flex-col h-full">
                    <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                        <img src="{{ asset('logo/icons/machine-learning.png') }}" alt="Technology Hub" class="w-8 h-8 object-contain">
                    </div>
                    <h3 class="text-xlg font-bold text-center mb-2">Technology-based</h3>
                    <p class="text-muted-foreground text-center mb-2 text-xs">Center of our innovation ecosystem</p>
                    <div class="mt-2 overflow-hidden rounded-lg">
                        <img src="{{ asset('images/drone technology.jpg') }}" 
                             alt="Drone technology in agriculture" 
                             class="w-full h-24 object-cover rounded-lg hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>

            <!-- Supporting Technologies -->
            <div class="ai-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all h-full flex flex-col relative w-80" id="card-6" style="min-height: 240px;">
                <div class="p-3 flex flex-col h-full">
                    <div class="w-16 h-16 rounded-full icon-bg border-2 border-[#f9fafb] flex items-center justify-center mx-auto mb-3 overflow-hidden">
                        <img src="{{ asset('logo/icons/iot.png') }}" alt="Supporting Technologies" class="w-8 h-8 object-contain">
                    </div>
                    <h3 class="text-xlg font-bold text-center mb-2">Supporting Technologies</h3>
                    <p class="text-muted-foreground text-center mb-3 text-base">Powering our digital transformation</p>
                    <div class="grid grid-cols-2 gap-1.5 mt-2">
                        <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                            <img src="{{ asset('logo/icons/smartphone.png') }}" alt="IoT" class="w-5 h-5">
                            <span class="text-xs font-medium">IoT Sensors</span>
                        </div>
                        <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                            <img src="{{ asset('logo/icons/drone.png') }}" alt="Drone" class="w-5 h-5">
                            <span class="text-xs font-medium">Drone Imaging</span>
                        </div>
                        <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                            <img src="{{ asset('logo/icons/camera-drone.png') }}" alt="Satellite" class="w-5 h-5">
                            <span class="text-xs font-medium">Satellite Data</span>
                        </div>
                        <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded-lg">
                            <img src="{{ asset('logo/icons/deep-learning.png') }}" alt="ML" class="w-5 h-5">
                            <span class="text-xs font-medium">ML Models</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Connection lines container (positioned absolutely within the section) -->
        <div class="connection-lines"></div>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const connectionLines = document.querySelector('.connection-lines');
            if (!connectionLines) return;
            
            // Define connections: [fromId, toId]
            const connections = [
                ['card-1', 'card-4'],     // Smart Seed Systems → Digital Climate Intelligence
                ['card-4', 'tech-hub'],   // Digital Climate Intelligence → Technology-based
                ['card-3', 'card-6'],     // Value Addition → Supporting Technologies
                ['card-6', 'tech-hub'],   // Supporting Technologies → Technology-based
                ['card-2', 'tech-hub']    // Financial Inclusion → Technology-based
            ];
            
            function updateLinePositions() {
                if (!connectionLines) return;
                
                // Clear existing lines
                connectionLines.innerHTML = '';
                
                // Get current scroll position
                const scrollX = window.pageXOffset || document.documentElement.scrollLeft;
                const scrollY = window.pageYOffset || document.documentElement.scrollTop;
                
                // Get the section's position
                const section = document.getElementById('ai-innovation');
                if (!section) return;
                
                connections.forEach(([fromId, toId], index) => {
                    const fromEl = document.getElementById(fromId);
                    const toEl = document.getElementById(toId);
                    
                    if (!fromEl || !toEl) return;
                    
                    // Get positions relative to the viewport
                    const fromRect = fromEl.getBoundingClientRect();
                    const toRect = toEl.getBoundingClientRect();
                    
                    // Calculate center points with scroll position
                    const fromCenter = {
                        x: fromRect.left + fromRect.width / 2,
                        y: fromRect.top + fromRect.height / 2
                    };
                    
                    const toCenter = {
                        x: toRect.left + toRect.width / 2,
                        y: toRect.top + toRect.height / 2
                    };
                    
                    // Calculate distance and angle
                    const dx = toCenter.x - fromCenter.x;
                    const dy = toCenter.y - fromCenter.y;
                    const length = Math.sqrt(dx * dx + dy * dy);
                    const angle = Math.atan2(dy, dx) * (180 / Math.PI);
                    
                    // Create line element
                    const line = document.createElement('div');
                    line.className = 'connection-line';
                    line.style.setProperty('--line-length', `${length}px`);
                    line.style.width = `${length}px`;
                    line.style.left = `${fromCenter.x}px`;
                    line.style.top = `${fromCenter.y}px`;
                    line.style.transform = `rotate(${angle}deg)`;
                    line.style.animationDelay = `${index * 0.1}s`;
                    
                    // Add arrow head only for the last segment to each destination
                    if (toId === 'tech-hub' || toId === 'card-4' || toId === 'card-6') {
                        line.style.overflow = 'visible';
                    }
                    
                    connectionLines.appendChild(line);
                });
            }
            
            // Initial draw with multiple checks to ensure everything is loaded
            const init = () => {
                // First try immediately
                updateLinePositions();
                
                // Then after a short delay
                setTimeout(updateLinePositions, 100);
                
                // And again after all resources are loaded
                window.addEventListener('load', updateLinePositions);
                
                // And one more time after a longer delay to be safe
                setTimeout(updateLinePositions, 500);
            };
            
            // Start initialization
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => {
                    init();
                });
            } else {
                init();
            }
            
            // Update on window resize with debounce
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    requestAnimationFrame(updateLinePositions);
                }, 100);
            });
            
            // Update on scroll with debounce
            let scrollTimer;
            const handleScroll = () => {
                if (!scrollTimer) {
                    requestAnimationFrame(() => {
                        updateLinePositions();
                        scrollTimer = null;
                    });
                }
            };
            
            window.addEventListener('scroll', handleScroll, { passive: true });
            
            // Force update after a short delay to ensure everything is in place
            setTimeout(updateLinePositions, 1000);
        });
        </script>
    </x-ui.container>
</section>
