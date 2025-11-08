<?php

namespace App\Services;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Log;

class LocalChatService
{
    protected array $knowledgeBase = [
        // About HarvestGlow
        'what is harvestglow' => [
            'HarvestGlow is a non-profit organization dedicated to transforming agriculture and empowering communities through sustainable farming practices and economic development initiatives.'
        ],
        'mission' => [
            'HarvestGlow\'s mission is to empower smallholder farmers and rural communities through sustainable agricultural practices, education, and economic opportunities, ultimately improving food security and livelihoods.'
        ],
        'operate' => [
            'HarvestGlow primarily operates in Malawi, with a focus on rural communities where we implement our agricultural and economic development programs.'
        ],
        'approach' => [
            'HarvestGlow\'s approach is built on four key elements:\n1. Sustainable Agriculture: Promoting climate-smart farming techniques\n2. Community Empowerment: Building local capacity and leadership\n3. Market Access: Connecting farmers to fair markets\n4. Education & Training: Providing knowledge and skills development'
        ],
        'founder' => [
            'HarvestGlow was founded by [Founder\'s Name] in 2022 with the vision of creating sustainable agricultural solutions for rural communities.'
        ],
        'difference' => [
            'HarvestGlow stands out through its community-led approach, focus on sustainable practices, and comprehensive support system that goes beyond just farming to include education, market access, and economic empowerment.'
        ],
        
        // Programs & Activities
        'programs' => [
            'HarvestGlow runs several key programs: Farmer Field Schools, Livestock and dairy development, Sustainable agriculture training, Women\'s empowerment programs, Youth skills development, and Market linkage initiatives.'
        ],
        'milk production' => [
            'In Likuni, HarvestGlow has implemented a comprehensive milk production training program that includes: dairy cattle management, milk processing and preservation, business skills for dairy farmers, establishment of milk collection centers, and market access for dairy products.'
        ],
        'join program' => [
            'Farmers interested in joining HarvestGlow\'s programs can:\n1. Visit our local office in [Location]\n2. Contact us through our website or hotline\n3. Attend one of our community outreach events\n4. Be referred by existing program participants'
        ],
        
        // Impact & Results
        'impact' => [
            'HarvestGlow has made significant impact through its programs:
            - 4,000+ people reached through sustainable agriculture and nutrition programs
            - 2,000+ youths and children engaged in educational initiatives
            - 1,500+ young people trained in digital and agricultural skills
            - 150+ entrepreneurs supported with capacity-building
            - 200 hectares of basic seed produced
            - $30,000 mobilized in seed capital to support trainings and innovations'
        ],
        'farmers reached' => [
            'HarvestGlow has reached 4,000+ people through sustainable agriculture, nutrition, and livelihoods programs.'
        ],
        'youth' => [
            '2,000+ youths and children have been engaged in school feeding, agri-nutrition clubs, and awareness campaigns.'
        ],
        'training' => [
            '1,500+ young people have been trained in digital skills, agribusiness, and climate-smart farming practices.'
        ],
        'entrepreneurs' => [
            '150+ entrepreneurs have been engaged in capacity-building, market linkages, and value chain development.'
        ],
        'seed production' => [
            '200 hectares of basic seed have been produced to strengthen food security and boost farmer productivity.'
        ],
        'funding' => [
            '$30,000 has been mobilized in seed capital to support trainings, community enterprises, and farmer-led innovations.'
        ],
        'success stories' => [
            'One of our success stories includes [brief story of impact]. For more detailed stories, please visit the "Impact" section of our website.'
        ],
        
        // Partnerships
        'partners' => [
            'HarvestGlow collaborates with various organizations including:\n- Local community groups\n- Government agricultural departments\n- International development agencies\n- Educational institutions\n- Private sector partners'
        ],
        'collaboration' => [
            'HarvestGlow works closely with local communities through:\n- Participatory planning and implementation\n- Capacity building of local leaders\n- Establishing farmer groups and cooperatives\n- Regular community consultations\n- Joint monitoring and evaluation'
        ],
        'partner with us' => [
            'Organizations interested in partnering with HarvestGlow can:\n1. Email us at [email]\n2. Visit our "Partners" page\n3. Contact our partnerships team directly\n4. Attend one of our partnership events'
        ],
        
        // Get Involved
        'donate' => [
            'You can support HarvestGlow by:\n1. Making a one-time or recurring donation on our website\n2. Sponsoring specific programs or communities\n3. Donating equipment or resources\n4. Including HarvestGlow in your will or as part of corporate social responsibility'
        ],
        'volunteer' => [
            'HarvestGlow offers various volunteer opportunities including:\n- Field work with farming communities\n- Training and capacity building\n- Administrative support\n- Fundraising and events\n- Technical expertise in agriculture, education, or business'
        ],
        'become beneficiary' => [
            'To become a beneficiary, individuals typically need to:\n1. Be part of our target communities\n2. Demonstrate need and commitment\n3. Participate in initial assessments\n4. Agree to program terms and conditions\n5. Actively participate in training and activities'
        ],
        
        // Team
        'team' => [
            'HarvestGlow is led by a dedicated team of professionals including:\n- [Founder/CEO Name], Founder & CEO\n- [Name], Program Director\n- [Name], Field Operations Manager\n- [Name], Training Coordinator\n- And many other committed staff and volunteers'
        ],
        'roles' => [
            'Our team members play various roles including:\n- Program development and management\n- Field implementation and training\n- Monitoring and evaluation\n- Community engagement\n- Fundraising and partnerships\n- Administrative support'
        ],
        
        // General/Default
        'default' => [
            'I\'m here to help you learn about HarvestGlow. You can ask me about our mission, programs, impact, or how to get involved.',
            'I don\'t have that specific information. Please visit our website or contact us directly for more details.'
        ]
    ];

    public function getResponse(string $message): array
    {
        try {
            $message = trim($message);
            $lowerMessage = strtolower($message);
            
            // Check if message contains a team member's name
            $teamMember = TeamMember::active()
                ->where(function($query) use ($message) {
                    $query->where('name', 'like', '%' . $message . '%')
                        ->orWhereRaw('LOWER(name) LIKE ?', ['%' . strtolower($message) . '%']);
                })
                ->first();

            if ($teamMember) {
                $response = "**{$teamMember->name}**";
                if ($teamMember->title) {
                    $response .= "\n*{$teamMember->title}*";
                }
                if ($teamMember->bio) {
                    $response .= "\n\n{$teamMember->bio}";
                }
                if ($teamMember->linkedin_url) {
                    $response .= "\n\n[View LinkedIn Profile]({$teamMember->linkedin_url})";
                }
                return [
                    'success' => true,
                    'message' => $response
                ];
            }
            
            // Greetings
            if (str_contains($lowerMessage, 'hello') || str_contains($lowerMessage, 'hi') || str_contains($lowerMessage, 'hey')) {
                return [
                    'success' => true,
                    'message' => 'Hello! 👋 I\'m the HarvestGlow Assistant. How can I help you learn more about our work today?'
                ];
            }

            // Get response key based on message
            $responseKey = $this->getResponseKey($message);
            
            // If we have a direct key match, use it
            if ($responseKey !== '') {
                // Special handling for founder information
                if ($responseKey === 'founder') {
                    $founderInfo = $this->getFounderInfo();
                    return [
                        'success' => true,
                        'message' => "HarvestGlow was founded by {$founderInfo} with the vision of creating sustainable agricultural solutions for rural communities."
                    ];
                }
                return $this->getRandomResponse($responseKey);
            }
            
            // If no direct key match, use the existing logic
            
            // About HarvestGlow
            if (str_contains($message, 'what is harvestglow') || str_contains($message, 'tell me about harvestglow')) {
                return $this->getRandomResponse('what is harvestglow');
            }
            
            if (str_contains($message, 'mission') || str_contains($message, 'purpose') || str_contains($message, 'goal')) {
                return $this->getRandomResponse('mission');
            }
            
            if (str_contains($message, 'where') && (str_contains($message, 'operate') || str_contains($message, 'location'))) {
                return $this->getRandomResponse('operate');
            }
            
            if ((str_contains($message, 'approach') || str_contains($message, 'method') || 
                 str_contains($message, 'key elements') || str_contains($message, 'four elements'))) {
                return $this->getRandomResponse('approach');
            }
            
            if (str_contains($message, 'found') && (str_contains($message, 'who') || str_contains($message, 'when'))) {
                $founderInfo = $this->getFounderInfo();
                return [
                    'success' => true,
                    'message' => "HarvestGlow was founded by {$founderInfo} with the vision of creating sustainable agricultural solutions for rural communities."
                ];
            }
            
            if (str_contains($message, 'different') || str_contains($message, 'unique') || 
                str_contains($message, 'set apart')) {
                return $this->getRandomResponse('difference');
            }
            
            // Programs & Activities
            if (str_contains($message, 'program') || str_contains($message, 'service') || 
                str_contains($message, 'offer') || str_contains($message, 'provide')) {
                return $this->getRandomResponse('programs');
            }
            
            if (str_contains($message, 'milk') || str_contains($message, 'dairy') || 
                str_contains($message, 'likuni')) {
                return $this->getRandomResponse('milk production');
            }
            
            if ((str_contains($message, 'join') || str_contains($message, 'participate') || 
                 str_contains($message, 'enroll')) && 
                (str_contains($message, 'program') || str_contains($message, 'initiative'))) {
                return $this->getRandomResponse('join program');
            }
            
            // Impact & Results
            if (str_contains($message, 'impact') || str_contains($message, 'result') || 
                str_contains($message, 'achievement')) {
                return $this->getRandomResponse('impact');
            }
            
            if ((str_contains($message, 'how many') || str_contains($message, 'number')) && 
                (str_contains($message, 'farmer') || str_contains($message, 'beneficiary'))) {
                return $this->getRandomResponse('farmers reached');
            }
            
            if (str_contains($message, 'success') || str_contains($message, 'story') || 
                str_contains($message, 'testimonial')) {
                return $this->getRandomResponse('success stories');
            }
            
            // Partnerships
            if (str_contains($message, 'partner') || str_contains($message, 'collaborat')) {
                if (str_contains($message, 'who') || str_contains($message, 'list')) {
                    return $this->getRandomResponse('partners');
                } elseif (str_contains($message, 'how') || str_contains($message, 'work with')) {
                    return $this->getRandomResponse('collaboration');
                } else {
                    return $this->getRandomResponse('partner with us');
                }
            }
            
            // Get Involved
            if (str_contains($message, 'donat') || str_contains($message, 'support') || 
                str_contains($message, 'contribute')) {
                return $this->getRandomResponse('donate');
            }
            
            if (str_contains($message, 'volunteer') || str_contains($message, 'help') || 
                str_contains($message, 'get involved')) {
                return $this->getRandomResponse('volunteer');
            }
            
            if (str_contains($message, 'beneficiary') || 
               (str_contains($message, 'how') && str_contains($message, 'participate'))) {
                return $this->getRandomResponse('become beneficiary');
            }
            
            // Team
            if (str_contains($message, 'team') || str_contains($message, 'staff') || 
                str_contains($message, 'who works') || str_contains($message, 'founder')) {
                // Special handling for founder questions
                if (str_contains($message, 'founder') || 
                    (str_contains($message, 'who') && str_contains($message, 'start')) ||
                    (str_contains($message, 'who') && str_contains($message, 'found'))) {
                    $founderInfo = $this->getFounderInfo();
                    return [
                        'success' => true,
                        'message' => "HarvestGlow was founded by {$founderInfo} with the vision of creating sustainable agricultural solutions for rural communities."
                    ];
                }
                return $this->getRandomResponse('team');
            }
            
            if (str_contains($message, 'role') || str_contains($message, 'who does what')) {
                return $this->getRandomResponse('roles');
            }
            
            // Default response if no keywords match
            return $this->getRandomResponse('default');

        } catch (\Exception $e) {
            Log::error('LocalChatService Error: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'I apologize, but I\'m having trouble responding right now. Please try again later or visit our website for more information.'
            ];
        }
    }
    
    /**
     * Get a random response from the specified knowledge base category
     */
    protected function getFounderInfo(): string
    {
        try {
            $founder = TeamMember::where('type', 'leadership')
                ->where('is_active', true)
                ->orderBy('order')
                ->first();
                
            if ($founder) {
                return $founder->name . ' in 2022 with shared vision to empower rural farmers through access to affordable, high-quality agricultural inputs, practical agronomic support, agri-value chain development, training, and markets';
            }
        } catch (\Exception $e) {
            Log::error('Error fetching founder info: ' . $e->getMessage());
        }
        
        return '[Founder\'s Name] in 2022';
    }
    
    protected function getResponseKey(string $message): string
    {
        $lowerMessage = strtolower(trim($message));
        
        // Check for exact matches first
        if (array_key_exists($lowerMessage, $this->knowledgeBase)) {
            return $lowerMessage;
        }
        
        // Check for partial matches
        foreach ($this->knowledgeBase as $key => $responses) {
            if (str_contains($lowerMessage, strtolower($key))) {
                return $key;
            }
        }
        
        return '';
    }

    protected function getRandomResponse(string $key): array
    {
        if (!isset($this->knowledgeBase[$key])) {
            $key = 'default';
        }
        
        $responses = $this->knowledgeBase[$key];
        $response = $responses[array_rand($responses)];
        
        return [
            'success' => true,
            'message' => $response
        ];
    }
}
