<flux:modal name="publication-form" class="min-w-[600px]">
    <div>
        <div class="py-4">
            <h3 class="text-lg font-semibold text-foreground">
                {{ $publicationId ? 'Edit Publication' : 'Add New Publication' }}
            </h3>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Title -->
            <flux:input 
                wire:model="title"
                label="Title"
                placeholder="e.g., Annual Report 2025"
                required
            />

            <!-- Publication Date -->
            <flux:input 
                wire:model="published_at"
                type="date"
                label="Publication Date"
            />

            <!-- Document Upload (Required for new; optional for edit) -->
            <div class="space-y-2">
                <flux:label>Document File</flux:label>
                @if($existing_document)
                    <p class="text-xs text-muted-foreground">Existing: 
                        <a href="{{ Storage::url($existing_document) }}" target="_blank" class="text-primary hover:underline">Download current</a>
                    </p>
                @endif
                <input
                    type="file"
                    id="publication-document-input"
                    wire:model="document"
                    accept="application/pdf"
                    class="block w-full text-sm text-foreground file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"
                />
                <p class="text-xs text-muted-foreground">Allowed: PDF only. Max 20MB.</p>
                <div wire:loading wire:target="document" class="text-xs text-muted-foreground">Uploading document...</div>
                @error('document')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- First Page Preview -->
            <div class="space-y-2">
                <flux:label>Preview</flux:label>
                <div class="border border-border rounded-lg p-3 bg-muted/20 flex items-center justify-center">
                    <canvas id="publication-pdf-preview" class="max-w-full" data-existing-url="{{ $publicationId && $existing_document ? route('publications.file', $publicationId) : '' }}"></canvas>
                </div>
                <p class="text-xs text-muted-foreground">Preview shows the first page of the PDF.</p>
            </div>

            <!-- Order -->
            <flux:input 
                wire:model="order"
                type="number"
                label="Display Order"
                placeholder="0"
                min="0"
                required
            />

            <!-- Active Status -->
            <flux:checkbox 
                wire:model="is_active"
                label="Active (Show on website)"
            />

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
                <flux:modal.close>
                    <flux:button variant="filled">Cancel</flux:button>
                </flux:modal.close>
                <flux:button 
                    type="submit" 
                    variant="primary"
                >
                    <span wire:loading.remove wire:target="save">
                        {{ $publicationId ? 'Update Publication' : 'Add Publication' }}
                    </span>
                    <span wire:loading wire:target="save">
                        {{ $publicationId ? 'Updating...' : 'Adding...' }}
                    </span>
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>

<!-- PDF.js for first-page preview -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    window.pdfjsLib = window.pdfjsLib || window['pdfjs-dist/build/pdf'];
    if (window.pdfjsLib && window.pdfjsLib.GlobalWorkerOptions) {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.worker.min.js';
    }

    async function renderPdfToCanvas(pdfUrlOrData, canvasId) {
        try {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext('2d');
            let loadingTask;
            if (pdfUrlOrData instanceof Uint8Array) {
                loadingTask = window.pdfjsLib.getDocument({ data: pdfUrlOrData, disableWorker: true });
            } else {
                loadingTask = window.pdfjsLib.getDocument({ url: pdfUrlOrData, disableWorker: true, disableAutoFetch: true, disableStream: true, disableRange: true });
            }
            const pdf = await loadingTask.promise;
            const page = await pdf.getPage(1);
            const viewport = page.getViewport({ scale: 0.8 });
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            await page.render({ canvasContext: ctx, viewport }).promise;
        } catch (e) {
            // silently fail preview
        }
    }

    // Show preview for selected file or existing file
    function initPublicationPreview() {
        const input = document.getElementById('publication-document-input');
        const canvas = document.getElementById('publication-pdf-preview');
        if (canvas) {
            const existingUrl = canvas.getAttribute('data-existing-url');
            if (existingUrl) {
                renderPdfToCanvas(existingUrl, 'publication-pdf-preview');
            }
        }
        if (input) {
            input.addEventListener('change', (e) => {
                const file = e.target.files && e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const bytes = new Uint8Array(ev.target.result);
                    renderPdfToCanvas(bytes, 'publication-pdf-preview');
                };
                reader.readAsArrayBuffer(file);
            });
        }
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('create-publication', () => {
            window.Flux.modal('publication-form').show();
            setTimeout(initPublicationPreview, 50);
        });
        Livewire.on('edit-publication', () => {
            window.Flux.modal('publication-form').show();
            setTimeout(initPublicationPreview, 50);
        });
        Livewire.on('publication-saved', () => {
            window.Flux.modal('publication-form').close();
        });
    });
</script>
