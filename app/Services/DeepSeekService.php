<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeepSeekService
{
    protected string $apiKey;

    protected string $apiUrl;

    protected string $model;

    protected string $systemPrompt;

    public function __construct()
    {
        $this->apiKey = config('services.deepseek.api_key');
        $this->apiUrl = config('services.deepseek.api_url', 'https://openrouter.ai/api/v1/chat/completions');
        $this->model = config('services.deepseek.model', 'deepseek/deepseek-chat-v3.1:free');
        $this->systemPrompt = $this->getHarvestGlowContext();
    }

    /**
     * Send a chat message and get AI response
     */
    public function chat(array $messages): array
    {
        try {
            // Add system context as the first message if not present
            if (empty($messages) || $messages[0]['role'] !== 'system') {
                array_unshift($messages, [
                    'role' => 'system',
                    'content' => $this->systemPrompt,
                ]);
            }

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->apiKey,
            ])->timeout(30)->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => $messages,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'success' => true,
                    'message' => $data['choices'][0]['message']['content'] ?? 'No response received.',
                    'usage' => $data['usage'] ?? null,
                ];
            }

            Log::error('DeepSeek API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'message' => 'Sorry, I encountered an error. Please try again.',
                'error' => $response->body(),
            ];
        } catch (\Exception $e) {
            Log::error('DeepSeek Service Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Sorry, I am unable to respond right now. Please try again later.',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get HarvestGlow context for the AI
     */
    protected function getHarvestGlowContext(): string
    {
        return <<<'CONTEXT'
You are an AI assistant for HarvestGlow, an organization dedicated to transforming agriculture and empowering communities in Zambia and beyond.

**CRITICAL INSTRUCTIONS:**
- ONLY provide information that is explicitly stated in this context
- If you don't have specific information, respond with: "I don't have that specific information. Please contact HarvestGlow directly through our contact page for accurate details."
- DO NOT make up or assume any information
- DO NOT provide specific numbers, dates, locations, or details unless they are explicitly mentioned below
- If asked about contact details, prices, specific programs, or enrollment - direct users to the contact page
- Stay within the boundaries of the information provided

**About HarvestGlow:**
HarvestGlow is committed to sustainable agricultural practices, community development, and economic empowerment. We work with smallholder farmers to improve crop yields, implement climate-smart farming techniques, and create market access for agricultural products.

**Our Mission:**
To empower rural communities through sustainable agriculture, innovation, and partnership, creating lasting positive impact on food security and livelihoods.

**Our Vision:**
A world where every farmer has access to the resources, knowledge, and opportunities needed to thrive and contribute to food security.

**Key Focus Areas:**
1. **Sustainable Agriculture** - Promoting eco-friendly farming practices that protect the environment
2. **Community Development** - Building capacity and infrastructure in rural communities
3. **Market Access** - Connecting farmers with markets and fair trade opportunities
4. **Training & Education** - Providing agricultural training and skills development
5. **Climate-Smart Farming** - Implementing practices that adapt to climate change
6. **Women & Youth Empowerment** - Special focus on empowering women and young farmers

**Services & Programs:**
- Agricultural training and extension services
- Access to quality seeds and farming inputs
- Post-harvest handling and storage solutions
- Market linkage programs
- Community organizing and farmer cooperatives
- Climate adaptation strategies
- Research and innovation in agriculture

**Impact:**
We work across multiple districts in Zambia, supporting thousands of smallholder farmers to increase their productivity, income, and resilience.

**Your Role:**
Help visitors learn about HarvestGlow's work, programs, and impact based ONLY on the information provided above. Answer questions about sustainable agriculture, our partnerships, how to get involved, and general inquiries about the organization. Be friendly, informative, and encouraging. 

For ANY specific details not mentioned above (contact numbers, email addresses, exact locations, pricing, program dates, application deadlines, staff names, etc.), respond with: "I don't have that specific information. Please visit our contact page or reach out to HarvestGlow directly for accurate details."

Always maintain a professional, warm, and helpful tone. Emphasize HarvestGlow's commitment to sustainable development and community empowerment, but NEVER fabricate information.
CONTEXT;
    }
}
