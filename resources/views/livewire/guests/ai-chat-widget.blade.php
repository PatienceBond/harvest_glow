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
                class="absolute bottom-full right-0 mb-2 px-3 py-2 bg-gray-900 text-white text-sm rounded-lg shadow-lg"
                style="display: none;"
            >
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3">
                    <button 
                        type="button"
                        wire:click="toggleChat"
                        class="text-white hover:text-primary transition-colors"
                        aria-label="Live chat"
                        title="Live chat"
                    >
                        Live chat
                    </button>
                    <a 
                        href="https://wa.me/265880856731"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center text-white hover:text-primary transition-colors"
                        aria-label="WhatsApp"
                        title="WhatsApp"
                    >
                        <!-- WhatsApp Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M20.52 3.48A11.94 11.94 0 0012.06 0C5.53 0 .25 5.27.25 11.78c0 2.07.54 4.08 1.57 5.86L0 24l6.5-1.7a11.76 11.76 0 005.57 1.42h.01c6.53 0 11.81-5.27 11.81-11.78 0-3.15-1.23-6.11-3.37-8.26zM12.08 21.3h-.01a9.5 9.5 0 01-4.84-1.32l-.35-.21-3.86 1.01 1.03-3.76-.23-.39a9.49 9.49 0 01-1.45-5.05c0-5.23 4.27-9.49 9.52-9.49 2.54 0 4.93.99 6.72 2.78a9.47 9.47 0 012.79 6.72c0 5.23-4.27 9.49-9.52 9.49zm5.46-7.12c-.3-.15-1.77-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.24-.46-2.36-1.47-.87-.77-1.46-1.72-1.63-2.01-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.67-.51-.17-.01-.37-.01-.57-.01-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.1 4.48.71.31 1.27.5 1.7.64.72.23 1.37.2 1.89.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35z"/>
                        </svg>
                    </a>
                    <a 
                        href="tel:+265880856731"
                        class="flex items-center justify-center text-white hover:text-primary transition-colors"
                        aria-label="Call"
                        title="Call"
                    >
                        <x-heroicon-o-phone class="w-5 h-5" />
                    </a>
                </div>
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
                   
                    <div>
                        <h3 class="font-semibold text-lg">HarvestGlow Assistant</h3>
                     
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
                                        <span class="text-xs font-semibold uppercase tracking-wide">Me</span>
                                    </div>
                                @else
                                    <div class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
                                        <span class="text-xs font-semibold uppercase tracking-wide">AI</span>
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
