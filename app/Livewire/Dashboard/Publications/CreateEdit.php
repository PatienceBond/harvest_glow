<?php

namespace App\Livewire\Dashboard\Publications;

use App\Models\Publication;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $publicationId = null;
    public $title = '';
    public $published_at = null;
    public $document;
    public $existing_document;
    public $order = 0;
    public $is_active = true;

    #[On('edit-publication')]
    public function loadPublication(int $publicationId): void
    {
        $this->publicationId = null;
        $this->title = '';
        $this->published_at = null;
        $this->document = null;
        $this->existing_document = null;
        $this->order = 0;
        $this->is_active = true;

        $publication = Publication::find($publicationId);
        if ($publication) {
            $this->publicationId = $publication->id;
            $this->title = $publication->title;
            $this->published_at = optional($publication->published_at)->toDateString();
            $this->existing_document = $publication->file_path;
            $this->order = $publication->order;
            $this->is_active = $publication->is_active;
        }
    }

    public function save(): void
    {
        $docRule = $this->publicationId ? 'nullable|mimes:pdf|max:20480' : 'required|mimes:pdf|max:20480';

        $this->validate([
            'title' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'document' => $docRule,
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $docPath = $this->existing_document;

            if ($this->document) {
                if ($this->existing_document && Storage::disk('public')->exists($this->existing_document)) {
                    Storage::disk('public')->delete($this->existing_document);
                }
                $docPath = $this->document->store('publications/docs', 'public');
            }

            $data = [
                'title' => $this->title,
                'published_at' => $this->published_at,
                'file_path' => $docPath,
                'order' => $this->order,
                'is_active' => $this->is_active,
            ];

            if ($this->publicationId) {
                Publication::findOrFail($this->publicationId)->update($data);
                $message = 'Publication updated successfully!';
            } else {
                Publication::create($data);
                $message = 'Publication added successfully!';
            }

            // Clear cached publications list for the guest page
            cache()->forget('publications.active');

            $this->reset();
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('publication-saved');
            $this->dispatch('refresh-publications');
        } catch (\Exception $e) {
            $this->dispatch('showToast', message: $e->getMessage(), type: 'error');
        }
    }

    public function removeDocument(): void
    {
        $this->document = null;
    }

    public function render()
    {
        return view('livewire.dashboard.publications.create-edit');
    }
}
