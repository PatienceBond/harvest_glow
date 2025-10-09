<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    public array $toasts = [];

    protected int $toastIdCounter = 0;

    #[On('showToast')]
    public function addToast(string $message = '', string $type = 'info', int $duration = 5000): void
    {
        $id = $this->toastIdCounter++;

        $this->toasts[] = [
            'id' => $id,
            'message' => $message ?: 'Notification',
            'type' => $type, // success, error, warning, info
            'duration' => $duration,
        ];
    }

    public function removeToast(int $id): void
    {
        $this->toasts = array_filter($this->toasts, fn ($toast) => $toast['id'] !== $id);
    }

    public function render()
    {
        return view('livewire.components.toast');
    }
}
