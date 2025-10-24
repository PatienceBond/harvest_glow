@props([
    'value' => '',
    'title' => '',
    'description' => '',
    'icon' => null
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6 text-center']) }}>
    <div class="space-y-4">
        @if($icon)
            <div class="flex justify-center">
                <x-dynamic-component :component="$icon" class="w-12 h-12 text-primary" />
            </div>
        @endif
        <div class="text-4xl font-bold text-primary">
            <span
                x-data="{
                    started: false,
                    raw: @js($value),
                    get end() { const s = String(this.raw).replace(/[^0-9.]/g, ''); return s ? parseFloat(s) : 0; },
                    get suffix() { const m = String(this.raw).match(/[^0-9.,\s]+$/); return m ? m[0] : ''; },
                    val: 0,
                    duration: 1200,
                    startTime: null,
                    format(n) { return Math.round(n).toLocaleString('en-US') + (this.suffix || ''); },
                    animate(ts) {
                        if (!this.startTime) this.startTime = ts;
                        const p = Math.min((ts - this.startTime) / this.duration, 1);
                        this.val = this.end * p;
                        if (p < 1) requestAnimationFrame(this.animate.bind(this));
                    },
                    start() {
                        if (this.started) return;
                        this.started = true;
                        requestAnimationFrame(this.animate.bind(this));
                    }
                }"
                x-init="
                    const obs = new IntersectionObserver((entries) => {
                        entries.forEach(e => { if (e.isIntersecting) { start(); obs.disconnect(); } });
                    }, { threshold: 0.3 });
                    obs.observe($el);
                "
                x-text="format(val)"
            ></span>
        </div>
        <h3 class="text-xl font-semibold">{{ $title }}</h3>
        <p class="text-muted-foreground">{{ $description }}</p>
    </div>
</div>
