<?php

namespace App\Livewire\Dashboard\TeamMembers;

use App\Models\TeamMember;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $memberId = null;

    public $name = '';

    public $title = '';

    public $bio = '';

    public $type = 'team';

    public $photo;

    public $existing_photo;

    public $order = 0;

    public $is_active = true;

    #[On('edit-member')]
    public function loadMember(int $memberId): void
    {
        // Clear old data first
        $this->memberId = null;
        $this->name = '';
        $this->title = '';
        $this->bio = '';
        $this->type = 'team';
        $this->photo = null;
        $this->existing_photo = null;
        $this->order = 0;
        $this->is_active = true;

        // Load the member
        $member = TeamMember::find($memberId);
        if ($member) {
            $this->memberId = $member->id;
            $this->name = $member->name;
            $this->title = $member->title;
            $this->bio = $member->bio ?? '';
            $this->type = $member->type;
            $this->existing_photo = $member->photo;
            $this->order = $member->order;
            $this->is_active = $member->is_active;
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'type' => 'required|in:leadership,team,board',
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            // Handle file upload
            $photoPath = $this->existing_photo;

            if ($this->photo) {
                // Delete old photo if exists
                if ($this->existing_photo && Storage::disk('public')->exists($this->existing_photo)) {
                    Storage::disk('public')->delete($this->existing_photo);
                }

                // Optimize and store new photo (400x400px square, WebP)
                $imageService = new ImageService();
                $photoPath = $imageService->optimizeTeamPhoto($this->photo, 400);
            }

            $data = [
                'name' => $this->name,
                'title' => $this->title,
                'bio' => $this->bio,
                'type' => $this->type,
                'photo' => $photoPath,
                'order' => $this->order,
                'is_active' => $this->is_active,
            ];

            if ($this->memberId) {
                $member = TeamMember::findOrFail($this->memberId);
                $member->update($data);
                $message = 'Team member updated successfully!';
            } else {
                TeamMember::create($data);
                $message = 'Team member added successfully!';
            }

            $this->reset();
            $this->dispatch('showToast', message: $message, type: 'success');

            $this->dispatch('member-saved');
            $this->dispatch('refresh-members'); // Trigger list refresh
        } catch (\Exception $e) {
            $this->dispatch('showToast', message: $e->getMessage(), type: 'error');
        }
    }

    public function removeFile(): void
    {
        $this->photo = null;
    }

    public function removeExistingPhoto(): void
    {
        $this->existing_photo = null;
    }

    public function render()
    {
        return view('livewire.dashboard.team-members.create-edit');
    }
}
