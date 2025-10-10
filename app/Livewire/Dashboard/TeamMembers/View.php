<?php

namespace App\Livewire\Dashboard\TeamMembers;

use App\Models\TeamMember;
use Livewire\Attributes\On;
use Livewire\Component;

class View extends Component
{
    public $member = null;

    #[On('view-member')]
    public function loadMember(int $memberId): void
    {
        $this->member = TeamMember::find($memberId);
    }

    public function render()
    {
        return view('livewire.dashboard.team-members.view');
    }
}
