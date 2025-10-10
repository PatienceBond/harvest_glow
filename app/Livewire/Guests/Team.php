<?php

namespace App\Livewire\Guests;

use App\Models\TeamMember;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Team extends Component
{
    public function render()
    {
        $leadershipTeam = TeamMember::active()
            ->leadership()
            ->ordered()
            ->get();

        $ourTeam = TeamMember::active()
            ->team()
            ->ordered()
            ->get();

        $boardMembers = TeamMember::active()
            ->board()
            ->ordered()
            ->get();

        return view('livewire.guests.team', [
            'leadershipTeam' => $leadershipTeam,
            'ourTeam' => $ourTeam,
            'boardMembers' => $boardMembers,
        ]);
    }
}
