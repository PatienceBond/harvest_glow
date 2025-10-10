<div>
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard.posts.index') }}" class="text-muted-foreground hover:text-foreground transition-colors">
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

        <h1 class="text-3xl font-bold text-foreground">Edit Post</h1>
        <p class="mt-2 text-muted-foreground">Update your blog post content and settings.</p>
    </div>

    <form wire:submit="update" class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title -->
                <flux:input 
                    wire:model="title"
                    label="Title"
                    placeholder="Enter post title"
                />

                <!-- Excerpt -->
                <flux:textarea 
                    wire:model="excerpt"
                    label="Excerpt"
                    rows="3"
                    placeholder="Brief description of the post"
                />

                <!-- Content Editor -->
                <flux:field>
                    <flux:label>Content</flux:label>
                    <div class="border border-border rounded-lg overflow-hidden">
                        <div class="bg-muted/30 px-4 py-2 border-b border-border">
                            <div class="flex items-center space-x-2">
                                <flux:button type="button" onclick="formatText('bold')" variant="ghost" size="xs">
                                    <x-heroicon-o-bold class="w-4 h-4" />
                                </flux:button>
                                <flux:button type="button" onclick="formatText('italic')" variant="ghost" size="xs">
                                    <x-heroicon-o-italic class="w-4 h-4" />
                                </flux:button>
                                <flux:button type="button" onclick="formatText('underline')" variant="ghost" size="xs">
                                    <x-heroicon-o-underline class="w-4 h-4" />
                                </flux:button>
                                <div class="w-px h-4 bg-border"></div>
                                <flux:button type="button" onclick="insertHeading()" variant="ghost" size="xs">H</flux:button>
                                <flux:button type="button" onclick="insertList()" variant="ghost" size="xs">
                                    <x-heroicon-o-list-bullet class="w-4 h-4" />
                                </flux:button>
                                <flux:button type="button" onclick="insertQuote()" variant="ghost" size="xs">
                                    <x-heroicon-o-chat-bubble-left-right class="w-4 h-4" />
                                </flux:button>
                            </div>
                        </div>
                        <textarea id="content"
                                  wire:model="content"
                                  rows="15"
                                  class="w-full px-4 py-3 border-0 focus:ring-0 resize-none"
                                  placeholder="Write your post content here..."></textarea>
                    </div>
                    <flux:error name="content" />
                </flux:field>

                <!-- Featured Image -->
                <flux:field>
                    <flux:label>Featured Image</flux:label>
                    
                    <!-- Show existing image if available -->
                    @if($existing_featured_image)
                        <div class="mb-4">
                            <flux:subheading>Current Image:</flux:subheading>
                            <div class="relative inline-block">
                                <img src="{{ Storage::url($existing_featured_image) }}"
                                     alt="Current featured image"
                                     class="h-32 w-auto rounded-lg border border-border">
                            </div>
                        </div>
                    @endif

                    <x-ui.file-upload
                        wireModel="featured_image"
                        accept="image/*"
                        maxSize="2048"
                        placeholder="Upload new featured image"
                    />
                    <flux:error name="featured_image" />
                </flux:field>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="bg-card border border-border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Publish Settings</h3>

                    <!-- Published Status -->
                    <flux:checkbox wire:model.live="is_published" label="Published" class="mb-4" />

                    <!-- Publish Date -->
                    <flux:input 
                        type="datetime-local"
                        wire:model="published_at"
                        label="Publish Date"
                    />
                </div>

                <!-- Category -->
                <div class="bg-card border border-border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Category</h3>
                    <flux:select wire:model="category_id">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </flux:select>
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
                        <flux:button 
                            type="submit"
                            variant="primary"
                            class="w-full"
                            wire:click="update"
                        >
                            <span wire:loading.remove wire:target="update">
                                Update Post
                            </span>
                            <span wire:loading wire:target="update">
                                Updating...
                            </span>
                        </flux:button>

                        <flux:button 
                            href="{{ route('dashboard.posts.index') }}"
                            variant="ghost"
                            class="w-full"
                        >
                            Cancel
                        </flux:button>
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