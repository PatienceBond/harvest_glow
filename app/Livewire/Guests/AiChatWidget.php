<?php

namespace App\Livewire\Guests;

use App\Services\LocalChatService;
use Livewire\Component;

class AiChatWidget extends Component
{
    public bool $isOpen = false;

    public string $userMessage = '';

    public array $messages = [];

    public bool $isLoading = false;

    public function mount(): void
    {
        // Initialize with welcome message
        $this->messages = [
            [
                'role' => 'assistant',
                'content' => 'Hello! 👋 I\'m here to help you learn about HarvestGlow and our mission to empower communities through sustainable agriculture. How can I assist you today?',
                'timestamp' => now()->format('H:i'),
            ],
        ];
    }

    public function toggleChat(): void
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function sendMessage(): void
    {
        if (empty(trim($this->userMessage))) {
            return;
        }

        // Add user message to chat
        $this->messages[] = [
            'role' => 'user',
            'content' => $this->userMessage,
            'timestamp' => now()->format('H:i'),
        ];

        $messageToSend = $this->userMessage;
        $this->userMessage = '';
        $this->isLoading = true;

        try {
            /** @var \App\Services\LocalChatService $chatService */
            $chatService = app(LocalChatService::class);
            $response = $chatService->getResponse($messageToSend, $this->messages);

            $this->messages[] = [
                'role' => 'assistant',
                'content' => $response['message'],
                'timestamp' => now()->format('H:i'),
            ];
        } catch (\Throwable $e) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => 'I do not have that information yet.',
                'timestamp' => now()->format('H:i'),
            ];
        } finally {
            $this->isLoading = false;
        }

        // Dispatch event to scroll to bottom
        $this->dispatch('message-sent');
    }

    public function clearChat(): void
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.guests.ai-chat-widget');
    }
}
