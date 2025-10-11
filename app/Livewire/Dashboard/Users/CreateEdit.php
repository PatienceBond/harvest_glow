<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $userId = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $avatar;
    public $existing_avatar;

    public function mount($userId = null)
    {
        $this->userId = $userId;
        
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->existing_avatar = $user->avatar;
            }
        }
    }

    #[On('create-user')]
    public function createUser()
    {
        $this->reset();
        $this->userId = null;
    }

    #[On('edit-user')]
    public function editUser($userId)
    {
        $this->userId = $userId;
        $user = User::find($userId);

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->existing_avatar = $user->avatar;
        }
    }

    public function save()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->userId, 'id')],
            'avatar' => ['nullable', 'image', 'max:1024'],
        ];

        if (!$this->userId || $this->password) {
            $rules['password'] = $this->userId 
                ? ['nullable', 'string', 'min:8', 'confirmed']
                : ['required', 'string', 'min:8', 'confirmed'];
        }

        $validated = $this->validate($rules);

        // Handle avatar upload with optimization
        $avatarPath = null;
        if ($this->avatar) {
            $imageService = new ImageService();
            // Optimize avatar: 200x200px, square crop, WebP format
            $avatarPath = $imageService->optimizeAvatar($this->avatar, 200);
        }

        if ($this->userId) {
            // Update existing user
            $user = User::find($this->userId);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            
            if ($avatarPath) {
                // Delete old avatar if exists
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $user->avatar = $avatarPath;
            }
            
            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            
            $user->save();
            
            // Show success toast and flash
            $this->dispatch('showToast', message: 'User updated successfully!', type: 'success');
            session()->flash('success', 'User updated successfully.');
        } else {
            // Create new user
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'avatar' => $avatarPath,
            ]);
            
            // Show success toast and flash
            $this->dispatch('showToast', message: 'User created successfully!', type: 'success');
            session()->flash('success', 'User created successfully.');
        }

        $this->dispatch('user-saved');
        $this->dispatch('refresh-users'); // Trigger list refresh
        $this->dispatch('close-modal');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.dashboard.users.create-edit');
    }
}

