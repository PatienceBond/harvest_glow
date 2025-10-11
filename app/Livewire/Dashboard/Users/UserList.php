<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $term = '';
    public $userId = null;

    #[On('user-saved')]
    #[On('refresh-users')]
    public function refresh(): void
    {
        // No logic needed; this just forces re-render
    }

    public function updatingTerm()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->userId = null;
        $this->dispatch('create-user');
    }

    public function edit($id)
    {
        $this->userId = $id;
        $this->dispatch('edit-user', userId: $id);
    }

    public function view($id)
    {
        $this->userId = $id;
        $this->dispatch('view-user', userId: $id);
    }

    public function delete($id)
    {
        $user = User::find($id);
        
        if ($user && $user->id !== auth()->id()) {
            $user->delete();
            session()->flash('success', 'User deleted successfully.');
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->term, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->term . '%')
                      ->orWhere('email', 'like', '%' . $this->term . '%');
                });
            })
            ->latest()
            ->paginate(12);

        return view('livewire.dashboard.users.user-list', [
            'users' => $users,
        ]);
    }
}

