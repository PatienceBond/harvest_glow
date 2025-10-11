<div class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <div x-data="{ tooltip: false }">
        @if(!$isOpen)
            <button 
                wire:click="toggleChat"
                @mouseenter="tooltip = true"
                @mouseleave="tooltip = false"
                class="bg-primary hover:bg-primary/90 text-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-primary/50"
                aria-label="Open chat"
            >
                <x-heroicon-o-chat-bubble-left-right class="h-6 w-6" />
            </button>
            
            <!-- Tooltip -->
            <div 
                x-show="tooltip"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute bottom-full right-0 mb-2 px-3 py-2 bg-gray-900 text-white text-sm rounded-lg shadow-lg whitespace-nowrap"
                style="display: none;"
            >
                Chat with us about HarvestGlow
                <div class="absolute top-full right-4 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
        @endif
    </div>

    <!-- Chat Window -->
    @if($isOpen)
        <div 
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-96 max-w-[calc(100vw-3rem)] flex flex-col overflow-hidden"
            style="height: 600px; max-height: calc(100vh - 8rem);"
            x-data="{ 
                scrollToBottom() {
                    setTimeout(() => {
                        const container = this.$refs.messagesContainer;
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    }, 100);
                }
            }"
            x-init="scrollToBottom()"
            @message-sent.window="scrollToBottom()"
        >
            <!-- Header -->
            <div class="bg-primary text-white px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 rounded-full p-2">
                        <x-heroicon-o-sparkles class="h-5 w-5" />
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">HarvestGlow Assistant</h3>
                        <p class="text-xs text-white/80">Ask me anything!</p>
                    </div>
                </div>
                <button 
                    wire:click="toggleChat"
                    class="hover:bg-white/20 rounded-full p-1 transition-colors"
                    aria-label="Close chat"
                >
                    <x-heroicon-o-x-mark class="h-6 w-6" />
                </button>
            </div>

            <!-- Messages Container -->
            <div 
                x-ref="messagesContainer"
                class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900"
            >
                @foreach($messages as $message)
                    <div class="flex {{ $message['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="flex gap-2 max-w-[85%] {{ $message['role'] === 'user' ? 'flex-row-reverse' : 'flex-row' }}">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                @if($message['role'] === 'user')
                                    <div class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center">
                                        <x-heroicon-o-user class="h-5 w-5" />
                                    </div>
                                @else
                                    <div class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
                                        <x-heroicon-o-sparkles class="h-5 w-5" />
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Message Bubble -->
                            <div class="flex flex-col {{ $message['role'] === 'user' ? 'items-end' : 'items-start' }}">
                                <div class="px-4 py-2 rounded-2xl {{ $message['role'] === 'user' ? 'bg-primary text-white' : 'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow' }}">
                                    <p class="text-sm whitespace-pre-wrap">{{ $message['content'] }}</p>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 px-2">
                                    {{ $message['timestamp'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Loading indicator -->
                @if($isLoading)
                    <div class="flex justify-start">
                        <div class="flex gap-2 max-w-[85%]">
                            <div class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">
                                <x-heroicon-o-sparkles class="h-5 w-5" />
                            </div>
                            <div class="bg-white dark:bg-gray-800 shadow rounded-2xl px-4 py-3">
                                <div class="flex gap-1">
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Input Area -->
            <div class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4">
                <form wire:submit="sendMessage" class="flex gap-2">
                    <input 
                        type="text" 
                        wire:model="userMessage"
                        placeholder="Type your message..."
                        class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400"
                        {{ $isLoading ? 'disabled' : '' }}
                    />
                    <button 
                        type="submit"
                        class="bg-primary hover:bg-primary/90 text-white rounded-full p-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ $isLoading ? 'disabled' : '' }}
                        aria-label="Send message"
                    >
                        <x-heroicon-o-paper-airplane class="h-5 w-5" />
                    </button>
                </form>
                
                <!-- Clear chat button -->
                <div class="mt-2 text-center">
                    <button 
                        wire:click="clearChat"
                        class="text-xs text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors"
                    >
                        Clear conversation
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
