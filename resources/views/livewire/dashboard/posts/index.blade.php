<div>
    <!-- Page Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Posts</h1>
            <p class="mt-2 text-muted-foreground">
                Manage your blog posts and content.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('dashboard.posts.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                New Post
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-card border border-border rounded-lg p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" 
                       wire:model.live.debounce.300ms="search"
                       placeholder="Search posts..."
                       class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div class="sm:w-48">
                <select wire:model.live="statusFilter" 
                        class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <div class="sm:w-48">
                <select wire:model.live="categoryFilter" 
                        class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
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
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                              style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}">
                                            {{ $post->category->name }}
                                        </span>
                                    @else
                                        <span class="text-sm text-muted-foreground">No category</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($post->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <x-heroicon-o-check-circle class="w-3 h-3 mr-1" />
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            <x-heroicon-o-clock class="w-3 h-3 mr-1" />
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                    {{ $post->published_at ? $post->published_at->format('M j, Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('dashboard.posts.edit', $post) }}" 
                                           class="text-primary hover:text-primary/80 transition-colors">
                                            <x-heroicon-o-pencil class="w-4 h-4" />
                                        </a>
                                        <button wire:click="deletePost({{ $post->id }})" 
                                                wire:confirm="Are you sure you want to delete this post?"
                                                class="text-destructive hover:text-destructive/80 transition-colors">
                                            <x-heroicon-o-trash class="w-4 h-4" />
                                        </button>
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
                        <a href="{{ route('dashboard.posts.create') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                            New Post
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
