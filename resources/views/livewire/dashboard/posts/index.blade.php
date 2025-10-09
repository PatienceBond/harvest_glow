<div>
    <!-- Page Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Posts</h1>
            <p class="mt-2 text-muted-foreground">Manage your blog posts and content.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <flux:button href="{{ route('dashboard.posts.create') }}" variant="primary" icon="plus">
                New Post
            </flux:button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-card border border-border rounded-lg p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <flux:input 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search posts..."
                />
            </div>
            <div class="sm:w-48">
                <flux:select wire:model.live="statusFilter">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </flux:select>
            </div>
            <div class="sm:w-48">
                <flux:select wire:model.live="categoryFilter">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </flux:select>
            </div>
        </div>
    </div>

    <!-- Posts Table -->
    <div class="bg-card border border-border rounded-lg overflow-hidden">
        @if($posts->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border">
                    <thead class="bg-muted/30">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                Post
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                Published
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach($posts as $post)
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($post->featured_image)
                                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" 
                                                     class="h-12 w-12 rounded-lg object-cover">
                                            @else
                                                <div class="h-12 w-12 bg-muted rounded-lg flex items-center justify-center">
                                                    <x-heroicon-o-document-text class="h-6 w-6 text-muted-foreground" />
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-foreground">
                                                {{ $post->title }}
                                            </div>
                                            <div class="text-sm text-muted-foreground">
                                                {{ Str::limit($post->excerpt, 60) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($post->category)
                                        <flux:badge size="sm" :style="'background-color: '.$post->category->color.'; color: white;'">
                                            {{ $post->category->name }}
                                        </flux:badge>
                                    @else
                                        <span class="text-sm text-muted-foreground">No category</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($post->is_published)
                                        <flux:badge color="green" size="sm" icon="check-circle">Published</flux:badge>
                                    @else
                                        <flux:badge color="yellow" size="sm" icon="clock">Draft</flux:badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                    {{ $post->published_at ? $post->published_at->format('M j, Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <flux:button href="{{ route('dashboard.posts.edit', $post) }}" variant="ghost" size="sm" icon="pencil" square />
                                        <flux:button 
                                            wire:click="deletePost({{ $post->id }})"
                                            wire:confirm="Are you sure you want to delete this post?"
                                            variant="danger" 
                                            size="sm" 
                                            icon="trash"
                                            square
                                        />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-border">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-muted-foreground" />
                <h3 class="mt-2 text-sm font-medium text-foreground">No posts found</h3>
                <p class="mt-1 text-sm text-muted-foreground">
                    @if($search || $statusFilter || $categoryFilter)
                        Try adjusting your search or filter criteria.
                    @else
                        Get started by creating a new post.
                    @endif
                </p>
                @if(!$search && !$statusFilter && !$categoryFilter)
                    <div class="mt-6">
                        <flux:button href="{{ route('dashboard.posts.create') }}" variant="primary" icon="plus">
                            New Post
                        </flux:button>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>