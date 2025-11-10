<?php

namespace App\Services;

use App\Services\Ai\AiChatClient;
use Illuminate\Support\Facades\Log;

class LocalChatService
{
    public function __construct(protected AiChatClient $client) {}

    public function getResponse(string $message, array $conversation = []): array
    {
        try {
            $context = trim((string) config('harvestglow-chat', ''));

            Log::debug('LocalChatService: context readiness check.', [
                'is_empty' => $context === '',
                'length' => strlen($context),
            ]);

            if ($context === '') {
                Log::warning('LocalChatService: context is empty, responding with fallback.');

                return $this->fallbackResponse();
            }

            $messages = $this->buildMessages($context, $conversation);

            $answer = $this->client->ask($messages);

            return [
                'success' => true,
                'message' => $answer,
            ];
        } catch (\Throwable $exception) {
            Log::error('LocalChatService Error: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            return $this->fallbackResponse();
        }
    }

    protected function buildMessages(string $context, array $conversation): array
    {
        $messages = [
            [
                'role' => 'system',
                'content' => 'You are HarvestGlow\'s official assistant. Answer using only the provided context. If the answer is missing, reply exactly: "I do not have that information yet." Keep responses concise and friendly.',
            ],
            [
                'role' => 'system',
                'content' => "Context:\n{$context}",
            ],
        ];

        foreach ($conversation as $item) {
            if (! isset($item['role'], $item['content'])) {
                continue;
            }

            $messages[] = [
                'role' => $item['role'] === 'assistant' ? 'assistant' : 'user',
                'content' => (string) $item['content'],
            ];
        }

        return $messages;
    }

    protected function fallbackResponse(): array
    {
        return [
            'success' => false,
            'message' => 'I do not have that information yet.',
        ];
    }
}
