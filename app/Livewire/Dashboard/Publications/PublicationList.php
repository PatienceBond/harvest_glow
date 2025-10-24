<?php

namespace App\Livewire\Dashboard\Publications;

use App\Models\Publication;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class PublicationList extends Component
{
    public $term = '';
    public $publicationId = null;

    #[On('$refresh')]
    #[On('refresh-publications')]
    #[On('publication-saved')]
    public function refresh(): void
    {
        // Re-render
    }

    public function updatedTerm($value)
    {
        $this->term = trim($value);
        if ($this->term === '') {
            $this->dispatch('$refresh');
        }
    }

    public function search()
    {
        $this->dispatch('$refresh');
    }

    public function create()
    {
        $this->publicationId = null;
        $this->dispatch('create-publication');
    }

    public function edit($id)
    {
        $this->publicationId = $id;
        $this->dispatch('edit-publication', publicationId: $id);
    }

    public function delete($id)
    {
        $pub = Publication::find($id);
        if ($pub) {
            if ($pub->file_path) {
                Storage::disk('public')->delete($pub->file_path);
            }
            $pub->delete();
            // Clear cached publications list for the guest page
            cache()->forget('publications.active');
            $this->dispatch('showToast', message: 'Publication deleted successfully!', type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function toggleActive($id)
    {
        $pub = Publication::find($id);
        if ($pub) {
            $pub->is_active = ! $pub->is_active;
            $pub->save();
            // Clear cached publications list for the guest page
            cache()->forget('publications.active');
            $message = $pub->is_active ? 'Publication activated!' : 'Publication deactivated!';
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        $query = Publication::query();

        if ($this->term) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->term . '%');
            });
        }

        $publications = $query->orderBy('order')->orderBy('created_at', 'desc')->get();

        return view('livewire.dashboard.publications.publication-list', [
            'publications' => $publications,
        ]);
    }
}
