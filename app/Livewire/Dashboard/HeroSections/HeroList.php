<?php

namespace App\Livewire\Dashboard\HeroSections;

use App\Models\HeroSection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class HeroList extends Component
{
    public $term = '';
    public $heroId = null;

    #[On('$refresh')]
    #[On('refresh-heroes')]
    #[On('hero-saved')]
    public function refresh(): void
    {
        // No logic needed; this just forces re-render
    }

    public function create()
    {
        $this->heroId = null;
        $this->dispatch('create-hero');
    }

    public function edit($id)
    {
        $this->heroId = $id;
        $this->dispatch('edit-hero', heroId: $id);
    }

    public function delete($id)
    {
        $hero = HeroSection::find($id);
        
        if ($hero) {
            // Delete image if exists
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            
            $hero->delete();
            
            $this->dispatch('showToast', message: 'Hero section deleted successfully!', type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function toggleActive($id)
    {
        $hero = HeroSection::find($id);
        
        if ($hero) {
            $hero->is_active = !$hero->is_active;
            $hero->save();
            
            $message = $hero->is_active ? 'Hero section activated!' : 'Hero section deactivated!';
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        $heroes = HeroSection::with('images')->orderBy('page')->get();

        return view('livewire.dashboard.hero-sections.hero-list', [
            'heroes' => $heroes,
        ]);
    }
}

