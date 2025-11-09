<!-- This is a temporary file that will be used to update the home.blade.php file -->
<style>
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
        border-left: 8px solid #3b82f6;
    }
    
    @keyframes drawLine {
        from { width: 0; opacity: 0; }
        to { width: var(--line-length); opacity: 0.6; }
    }
    
    @media (max-width: 768px) {
        .connection-lines, .connection-line {
            display: none;
        }
    }
</style>

<!-- Add this right before the closing </section> tag of the AI Innovation section -->
<div class="connection-lines"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const techHub = document.getElementById('tech-hub');
    const connectionLines = document.querySelector('.connection-lines');
    
    if (!techHub || !connectionLines) return;
    
    function updateLinePositions() {
        // Clear existing lines
        connectionLines.innerHTML = '';
        
        // Get position of the tech hub card
        const techRect = techHub.getBoundingClientRect();
        const techCenter = {
            x: techRect.left + techRect.width / 2,
            y: techRect.top + techRect.height / 2
        };
        
        // Connect each card to the tech hub
        document.querySelectorAll('.ai-card:not(#tech-hub)').forEach((card, index) => {
            const cardRect = card.getBoundingClientRect();
            const cardCenter = {
                x: cardRect.left + cardRect.width / 2,
                y: cardRect.top + cardRect.height / 2
            };
            
            // Calculate distance and angle
            const dx = techCenter.x - cardCenter.x;
            const dy = techCenter.y - cardCenter.y;
            const length = Math.sqrt(dx * dx + dy * dy);
            const angle = Math.atan2(dy, dx) * (180 / Math.PI);
            
            // Create line element
            const line = document.createElement('div');
            line.className = 'connection-line';
            line.style.setProperty('--line-length', `${length}px`);
            line.style.width = `${length}px`;
            line.style.left = `${cardCenter.x}px`;
            line.style.top = `${cardCenter.y}px`;
            line.style.transform = `rotate(${angle}deg)`;
            line.style.animationDelay = `${index * 0.1}s`;
            
            connectionLines.appendChild(line);
        });
    }
    
    // Initial draw
    updateLinePositions();
    
    // Update on window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(updateLinePositions, 250);
    });
});
</script>
