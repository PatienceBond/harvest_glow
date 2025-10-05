<div>
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard.posts.index') }}" 
                       class="text-muted-foreground hover:text-foreground transition-colors">
                        Posts
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <x-heroicon-o-chevron-right class="w-4 h-4 text-muted-foreground" />
                        <span class="ml-1 text-foreground md:ml-2">Edit Post</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <h1 class="text-3xl font-bold text-foreground mt-4">Edit Post</h1>
        <p class="mt-2 text-muted-foreground">
            Update your blog post content and settings.
        </p>
    </div>

    <form wire:submit="update" class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium mb-2">Title</label>
                    <input type="text" 
                           id="title"
                           wire:model="title"
                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-destructive @enderror"
                           placeholder="Enter post title">
                    @error('title')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium mb-2">Excerpt</label>
                    <textarea id="excerpt"
                              wire:model="excerpt"
                              rows="3"
                              class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('excerpt') border-destructive @enderror"
                              placeholder="Brief description of the post"></textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content Editor -->
                <div>
                    <label for="content" class="block text-sm font-medium mb-2">Content</label>
                    <div class="border border-border rounded-lg overflow-hidden">
                        <div class="bg-muted/30 px-4 py-2 border-b border-border">
                            <div class="flex items-center space-x-2">
                                <button type="button" 
                                        onclick="formatText('bold')"
                                        class="p-1 hover:bg-muted rounded transition-colors"
                                        title="Bold">
                                    <x-heroicon-o-bold class="w-4 h-4" />
                                </button>
                                <button type="button" 
                                        onclick="formatText('italic')"
                                        class="p-1 hover:bg-muted rounded transition-colors"
                                        title="Italic">
                                    <x-heroicon-o-italic class="w-4 h-4" />
                                </button>
                                <button type="button" 
                                        onclick="formatText('underline')"
                                        class="p-1 hover:bg-muted rounded transition-colors"
                                        title="Underline">
                                    <x-heroicon-o-underline class="w-4 h-4" />
                                </button>
                                <div class="w-px h-4 bg-border"></div>
                                <button type="button" 
                                        onclick="insertHeading()"
                                        class="p-1 hover:bg-muted rounded transition-colors"
                                        title="Heading">
                                    H
                                </button>
                                <button type="button" 
                                        onclick="insertList()"
                                        class="p-1 hover:bg-muted rounded transition-colors"
                                        title="List">
                                    <x-heroicon-o-list-bullet class="w-4 h-4" />
                                </button>
                                <button type="button" 
                                        onclick="insertQuote()"
                                        class="p-1 hover:bg-muted rounded transition-colors"
                                        title="Quote">
                                    <x-heroicon-o-chat-bubble-left-right class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                        <textarea id="content"
                                  wire:model="content"
                                  rows="15"
                                  class="w-full px-4 py-3 border-0 focus:ring-0 resize-none @error('content') border-destructive @enderror"
                                  placeholder="Write your post content here..."></textarea>
                    </div>
                    @error('content')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div>
                    <label class="block text-sm font-medium mb-2">Featured Image</label>
                    <x-ui.file-upload 
                        wireModel="featured_image"
                        accept="image/*"
                        maxSize="2048"
                        placeholder="Upload featured image"
                    />
                    @error('featured_image')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="bg-card border border-border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Publish Settings</h3>
                    
                    <!-- Published Status -->
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   wire:model="is_published"
                                   class="rounded border-border text-primary focus:ring-primary">
                            <span class="ml-2 text-sm font-medium">Published</span>
                        </label>
                    </div>

                    <!-- Publish Date -->
                    <div>
                        <label for="published_at" class="block text-sm font-medium mb-2">Publish Date</label>
                        <input type="datetime-local" 
                               id="published_at"
                               wire:model="published_at"
                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>

                <!-- Category -->
                <div class="bg-card border border-border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Category</h3>
                    <select wire:model="category_id" 
                            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Post Info -->
                <div class="bg-card border border-border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Post Information</h3>
                    <div class="space-y-2 text-sm text-muted-foreground">
                        <p><strong>Created:</strong> {{ $post->created_at->format('M j, Y g:i A') }}</p>
                        <p><strong>Updated:</strong> {{ $post->updated_at->format('M j, Y g:i A') }}</p>
                        <p><strong>Author:</strong> {{ $post->user->name }}</p>
                        @if($post->slug)
                            <p><strong>Slug:</strong> {{ $post->slug }}</p>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-card border border-border rounded-lg p-6">
                    <div class="space-y-3">
                        <button type="submit" 
                                wire:loading.attr="disabled"
                                wire:target="update"
                                class="w-full bg-primary text-white py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="update">
                                Update Post
                            </span>
                            <span wire:loading wire:target="update" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Updating...
                            </span>
                        </button>
                        
                        <a href="{{ route('dashboard.posts.index') }}" 
                           class="block w-full bg-secondary text-secondary-foreground py-3 px-4 rounded-lg hover:bg-secondary/90 transition-colors font-medium text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function formatText(command) {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            
            let formattedText = '';
            switch(command) {
                case 'bold':
                    formattedText = `**${selectedText}**`;
                    break;
                case 'italic':
                    formattedText = `*${selectedText}*`;
                    break;
                case 'underline':
                    formattedText = `<u>${selectedText}</u>`;
                    break;
            }
            
            textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
            textarea.focus();
            textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
        }
        
        function insertHeading() {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const heading = '## Heading\n\n';
            textarea.value = textarea.value.substring(0, start) + heading + textarea.value.substring(start);
            textarea.focus();
            textarea.setSelectionRange(start + heading.length - 2, start + heading.length - 2);
        }
        
        function insertList() {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const list = '- List item\n- Another item\n\n';
            textarea.value = textarea.value.substring(0, start) + list + textarea.value.substring(start);
            textarea.focus();
            textarea.setSelectionRange(start + list.length, start + list.length);
        }
        
        function insertQuote() {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const quote = '> Quote text here\n\n';
            textarea.value = textarea.value.substring(0, start) + quote + textarea.value.substring(start);
            textarea.focus();
            textarea.setSelectionRange(start + quote.length - 2, start + quote.length - 2);
        }
    </script>
</div>
