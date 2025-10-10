<?php

namespace App\Livewire\Dashboard\TeamMembers;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class TeamMemberPage extends Component
{
    public function render()
    {
        return view('livewire.dashboard.team-members.team-member-page');
    }
}
