<div>
    <!-- Search and Actions -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="flex-1">
            <flux:input 
                wire:model.live.debounce.300ms="term"
                placeholder="Search publications..."
                icon="magnifying-glass"
            />
        </div>
        <flux:button wire:click="create" variant="primary" icon="plus">
            Add Publication
        </flux:button>
    </div>

    <!-- Publications Table -->
    <div class="bg-card border border-border rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/30 border-b border-border">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Preview
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Published
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Document
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Order
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($publications as $pub)
                        <tr class="hover:bg-muted/20 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-20 h-20 bg-muted rounded-lg flex items-center justify-center overflow-hidden">
                                    @php $isPdf = \Illuminate\Support\Str::endsWith(strtolower($pub->file_path), '.pdf'); @endphp
                                    @if($isPdf)
                                        <canvas id="pub-preview-{{ $pub->id }}" width="80" height="80" data-pdf-url="{{ route('publications.file', $pub) }}"></canvas>
                                    @else
                                        <x-heroicon-o-document-text class="w-8 h-8 text-muted-foreground" />
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium">{{ $pub->title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-muted-foreground">
                                    {{ $pub->published_at ? $pub->published_at->format('M j, Y') : '—' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($pub->file_path)
                                    <a href="{{ route('publications.download', $pub) }}" class="text-primary hover:underline inline-flex items-center gap-1">
                                        <x-heroicon-o-arrow-down-tray class="w-4 h-4" /> Download
                                    </a>
                                @else
                                    <span class="text-xs text-muted-foreground">No file</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge>{{ $pub->order }}</flux:badge>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge :color="$pub->is_active ? 'green' : 'red'">
                                    {{ $pub->is_active ? 'Active' : 'Inactive' }}
                                </flux:badge>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <flux:button 
                                    wire:click="toggleActive({{ $pub->id }})"
                                    variant="ghost" 
                                    size="sm"
                                    icon="{{ $pub->is_active ? 'eye-slash' : 'eye' }}"
                                />
                                <flux:button 
                                    wire:click="edit({{ $pub->id }})"
                                    variant="ghost" 
                                    size="sm"
                                    icon="pencil"
                                />
                                <flux:button 
                                    wire:click="delete({{ $pub->id }})"
                                    wire:confirm="Are you sure you want to delete this publication?"
                                    variant="ghost" 
                                    size="sm"
                                    icon="trash"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-muted-foreground">
                                <div class="flex flex-col items-center">
                                    <x-heroicon-o-document class="w-12 h-12 mb-3 text-muted-foreground/50" />
                                    <p>No publications found.</p>
                                    <flux:button wire:click="create" variant="primary" size="sm" class="mt-3">
                                        Add Your First Publication
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- PDF.js and inline renderer for first-page thumbnails -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        (function(){
            const pdfjsLib = window['pdfjs-dist/build/pdf'] || window.pdfjsLib;
            if (pdfjsLib && pdfjsLib.GlobalWorkerOptions) {
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.worker.min.js';
            }

            async function renderCanvas(canvas){
                try {
                    const url = canvas.getAttribute('data-pdf-url');
                    if (!url) return;
                    const pdf = await pdfjsLib.getDocument({ url, disableWorker: true }).promise;
                    const page = await pdf.getPage(1);
                    const base = page.getViewport({ scale: 1 });
                    const targetWidth = 80; // fit canvas width
                    const scale = targetWidth / base.width;
                    const viewport = page.getViewport({ scale });
                    const THUMB_PORTION = 0.25; // top quarter
                    const off = document.createElement('canvas');
                    off.width = viewport.width;
                    off.height = viewport.height;
                    const offCtx = off.getContext('2d');
                    await page.render({ canvasContext: offCtx, viewport }).promise;

                    const ctx = canvas.getContext('2d');
                    canvas.width = viewport.width;
                    canvas.height = Math.max(1, Math.floor(viewport.height * THUMB_PORTION));
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(
                        off,
                        0, 0, off.width, off.height * THUMB_PORTION,
                        0, 0, canvas.width, canvas.height
                    );
                } catch(e) {}
            }

            function renderAll() {
                document.querySelectorAll('canvas[id^="pub-preview-"]').forEach(renderCanvas);
            }
            document.addEventListener('DOMContentLoaded', renderAll);
            document.addEventListener('livewire:init', () => {
                if (window.Livewire && Livewire.hook) {
                    Livewire.hook('message.processed', () => renderAll());
                }
            });
            // Render immediately on first load
            renderAll();
        })();
    </script>
</div>
