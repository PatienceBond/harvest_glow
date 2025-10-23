<div>
    <!-- Hero Section (From Database if available) -->
    @if($heroSection)
        <x-ui.hero
            image="{{ $heroSection->image ? Storage::url($heroSection->image) : asset('images/hero/hero1.webp') }}"
            heading="{{ $heroSection->heading }}"
            subheading=""
            height="350px"
            align="center"
            headingClass="text-3xl md:text-4xl font-bold"
            contentPaddingClass="py-20"
            class="text-white"
        />
    @else
        <x-ui.hero
            image="{{ asset('images/hero/hero1.webp') }}"
            heading="Publications"
            height="350px"
            align="center"
            headingClass="text-3xl md:text-4xl font-bold"
            contentPaddingClass="py-20"
            class="text-white"
        />
    @endif

    <x-ui.container>
        <div class="py-10">
            @if($publications->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($publications as $pub)
                        <div class="bg-card border border-border rounded-lg overflow-hidden">
                            <div class="w-full h-56 bg-muted flex items-center justify-center overflow-hidden">
                                @php $isPdf = \Illuminate\Support\Str::endsWith(strtolower($pub->file_path), '.pdf'); @endphp
                                @if($isPdf)
                                    <canvas id="pub-card-{{ $pub->id }}" data-pdf-url="{{ route('publications.file', $pub) }}" class="max-w-full"></canvas>
                                @else
                                    <x-heroicon-o-document-text class="w-12 h-12 text-muted-foreground" />
                                @endif
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-2">{{ $pub->title }}</h3>
                                <p class="text-xs text-muted-foreground mb-4">{{ $pub->published_at ? $pub->published_at->format('M j, Y') : '—' }}</p>
                                <x-ui.button-link href="{{ route('publications.download', $pub) }}" variant="primary" class="inline-flex items-center gap-2">
                                    <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                                    Download
                                </x-ui.button-link>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 text-muted-foreground">
                    <x-heroicon-o-document class="w-12 h-12 mx-auto mb-3 text-muted-foreground/50" />
                    <p>No publications available yet. Please check back later.</p>
                </div>
            @endif
        </div>
    </x-ui.container>
    
    <!-- PDF.js for first-page previews -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        (function(){
            const pdfjsLib = window['pdfjs-dist/build/pdf'] || window.pdfjsLib;
            if (pdfjsLib && pdfjsLib.GlobalWorkerOptions) {
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.worker.min.js';
            }

            async function renderCard(canvas){
                try{
                    const url = canvas.getAttribute('data-pdf-url');
                    if (!url) return;
                    const pdf = await pdfjsLib.getDocument({ url, disableWorker: true }).promise;
                    const page = await pdf.getPage(1);
                    const containerWidth = canvas.parentElement.clientWidth || 600;
                    const baseViewport = page.getViewport({ scale: 1 });
                    const scale = containerWidth / baseViewport.width;
                    const viewport = page.getViewport({ scale });
                    const PREVIEW_PORTION = 0.5; // top half

                    // Render full page to offscreen first
                    const off = document.createElement('canvas');
                    off.width = viewport.width;
                    off.height = viewport.height;
                    const offCtx = off.getContext('2d');
                    await page.render({ canvasContext: offCtx, viewport }).promise;

                    // Draw top portion onto visible canvas
                    canvas.width = viewport.width;
                    canvas.height = Math.max(1, Math.floor(viewport.height * PREVIEW_PORTION));
                    const ctx = canvas.getContext('2d');
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(
                        off,
                        0, 0, off.width, off.height * PREVIEW_PORTION,
                        0, 0, canvas.width, canvas.height
                    );
                } catch(e) {}
            }

            function renderAll(){
                document.querySelectorAll('canvas[id^="pub-card-"]').forEach(renderCard);
            }

            document.addEventListener('DOMContentLoaded', renderAll);
            document.addEventListener('livewire:init', () => {
                if (window.Livewire && Livewire.hook) {
                    Livewire.hook('message.processed', () => renderAll());
                }
            });
            window.addEventListener('resize', () => renderAll());
            // Render immediately in case DOMContentLoaded already fired
            renderAll();
        })();
    </script>
</div>
