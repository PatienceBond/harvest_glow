@props([
    'title' => '',
    'progress' => 0,
    'current' => '',
    'goal' => ''
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6']) }}
     x-data="{
        started:false,
        val:0,
        target:@js($progress),
        duration:1200,
        startTime:null,
        animate(ts){
           if(!this.startTime) this.startTime = ts;
           const p = Math.min((ts - this.startTime)/this.duration, 1);
           this.val = this.target * p;
           if(p < 1) requestAnimationFrame(this.animate.bind(this));
        },
        start(){ if(this.started) return; this.started = true; requestAnimationFrame(this.animate.bind(this)); }
     }"
     x-init="
        const obs = new IntersectionObserver((entries) => {
           entries.forEach(e => { if(e.isIntersecting){ start(); obs.disconnect(); } });
        }, { threshold: 0.3 });
        obs.observe($el);
     "
>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">{{ $title }}</h3>
        <span class="text-2xl font-bold text-primary" x-text="Math.round(val) + '%'">{{ $progress }}%</span>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-muted rounded-full h-3 mb-4">
        <div class="bg-primary h-3 rounded-full transition-all duration-700" :style="{ width: (val) + '%' }" style="width: 0%"></div>
    </div>

    <!-- Current and Goal -->
    <div class="flex justify-between text-sm text-muted-foreground">
        <span>Current: {{ $current }}</span>
        <span>Goal: {{ $goal }}</span>
    </div>
</div>
