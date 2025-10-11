<?php

namespace App\Livewire\Dashboard\TeamMembers;

use App\Models\TeamMember;
use Livewire\Attributes\On;
use Livewire\Component;

class TeamMemberList extends Component
{
    public $term = '';

    public $typeFilter = '';

    public $memberId = null;

    #[On('$refresh')]
    #[On('refresh-members')]
    #[On('member-saved')]
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

    public function edit(int $memberId): void
    {
        $this->dispatch('edit-member', memberId: $memberId);
    }

    public function view(int $memberId): void
    {
        $this->dispatch('view-member', memberId: $memberId);
    }

    public function delete($memberId): void
    {
        $member = TeamMember::findOrFail($memberId);

        $member->delete();

        $this->dispatch('showToast', message: 'Team member deleted successfully!', type: 'success');

        $this->term = '';
    }

    public function render()
    {
        $members = TeamMember::query()
            ->when($this->term, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->term.'%')
                        ->orWhere('title', 'like', '%'.$this->term.'%')
                        ->orWhere('bio', 'like', '%'.$this->term.'%');
                });
            })
            ->when($this->typeFilter, function ($query) {
                $query->where('type', $this->typeFilter);
            })
            ->ordered()
            ->limit(50)
            ->get();

        return view('livewire.dashboard.team-members.team-member-list', [
            'members' => $members,
        ]);
    }
}
