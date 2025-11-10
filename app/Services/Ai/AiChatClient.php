<?php

namespace App\Services\Ai;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiChatClient
{
    public function ask(array $messages): string
    {
        $apiKey = config('services.deepseek.api_key');
        $endpoint = rtrim(config('services.deepseek.api_url'), '/');
        $model = config('services.deepseek.model');

        Log::debug('AiChatClient: configuration status', [
            'has_api_key' => ! blank($apiKey),
            'has_endpoint' => ! blank($endpoint),
            'has_model' => ! blank($model),
        ]);

        if (blank($apiKey) || blank($model) || blank($endpoint)) {
            Log::error('AiChatClient: configuration incomplete.', [
                'has_api_key' => ! blank($apiKey),
                'has_endpoint' => ! blank($endpoint),
                'has_model' => ! blank($model),
            ]);
            throw new \RuntimeException('AI configuration is incomplete.');
        }

        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => 0.1,
            'max_tokens' => 600,
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apiKey}",
            'Content-Type' => 'application/json',
        ])->timeout(30)->post($endpoint, $payload);

        if ($response->failed()) {
            $response->throw();
        }

        $responseBody = $response->json();
        $content = data_get($responseBody, 'choices.0.message.content');

        if (blank($content)) {
            Log::warning('AI response missing content', ['body' => $responseBody]);
            throw new \RuntimeException('AI response did not contain any content.');
        }

        return trim($content);
    }
}
