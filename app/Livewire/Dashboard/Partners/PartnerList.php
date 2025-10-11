<?php

namespace App\Livewire\Dashboard\Partners;

use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class PartnerList extends Component
{
    public $term = '';
    public $categoryFilter = '';
    public $partnerId = null;

    #[On('$refresh')]
    #[On('refresh-partners')]
    #[On('partner-saved')]
    public function refresh(): void
    {
        // No logic needed; this just forces re-render
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
        $this->partnerId = null;
        $this->dispatch('create-partner');
    }

    public function edit($id)
    {
        $this->partnerId = $id;
        $this->dispatch('edit-partner', partnerId: $id);
    }

    public function delete($id)
    {
        $partner = Partner::find($id);
        
        if ($partner) {
            // Delete logo if exists
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            
            $partner->delete();
            
            $this->dispatch('showToast', message: 'Partner deleted successfully!', type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function toggleActive($id)
    {
        $partner = Partner::find($id);
        
        if ($partner) {
            $partner->is_active = !$partner->is_active;
            $partner->save();
            
            $message = $partner->is_active ? 'Partner activated!' : 'Partner deactivated!';
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        $query = Partner::query();

        if ($this->term) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->term . '%')
                  ->orWhere('description', 'like', '%' . $this->term . '%');
            });
        }

        if ($this->categoryFilter) {
            $query->where('category', $this->categoryFilter);
        }

        $partners = $query->orderBy('order')->orderBy('created_at', 'desc')->get();

        return view('livewire.dashboard.partners.partner-list', [
            'partners' => $partners,
        ]);
    }
}

