<?php

namespace Tests\Unit;

use App\Services\Ai\AiChatClient;
use App\Services\LocalChatService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Tests\TestCase;

class LocalChatServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_it_asks_ai_with_context_and_conversation_history(): void
    {
        config()->set('harvestglow-chat', "HarvestGlow Overview\nKey facts.");

        $client = Mockery::mock(AiChatClient::class);
        $client->shouldReceive('ask')
            ->once()
            ->with(Mockery::on(function (array $messages) {
                $this->assertCount(4, $messages);
                $this->assertSame('system', $messages[0]['role']);
                $this->assertStringContainsString('HarvestGlow\'s official assistant', $messages[0]['content']);
                $this->assertSame('system', $messages[1]['role']);
                $this->assertStringContainsString('HarvestGlow Overview', $messages[1]['content']);
                $this->assertSame('assistant', $messages[2]['role']);
                $this->assertSame('user', $messages[3]['role']);
                $this->assertSame('User question?', $messages[3]['content']);

                return true;
            }))
            ->andReturn('Here is the information you requested.');

        $service = new LocalChatService($client);

        $conversation = [
            ['role' => 'assistant', 'content' => 'Welcome!'],
            ['role' => 'user', 'content' => 'User question?'],
        ];

        $response = $service->getResponse('User question?', $conversation);

        $this->assertTrue($response['success']);
        $this->assertSame('Here is the information you requested.', $response['message']);
    }

    public function test_it_returns_fallback_when_ai_client_fails(): void
    {
        config()->set('harvestglow-chat', 'Context data');

        $client = Mockery::mock(AiChatClient::class);
        $client->shouldReceive('ask')
            ->once()
            ->andThrow(new \RuntimeException('network failure'));

        $service = new LocalChatService($client);

        $response = $service->getResponse('Anything', [
            ['role' => 'user', 'content' => 'Anything'],
        ]);

        $this->assertFalse($response['success']);
        $this->assertSame('I do not have that information yet.', $response['message']);
    }
}
