<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-foreground">Dashboard</h1>
        <p class="mt-2 text-muted-foreground">
            Welcome back, {{ auth()->user()->name }}. Here's what's happening with your content.
        </p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Posts Count -->
        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-500/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-document-text class="w-5 h-5 text-blue-600" />
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">Total Posts</p>
                    <p class="text-2xl font-bold text-foreground">{{ $totalPosts }}</p>
                </div>
            </div>
        </div>

        <!-- Published Posts -->
        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-check-circle class="w-5 h-5 text-green-600" />
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">Published</p>
                    <p class="text-2xl font-bold text-foreground">{{ $publishedPosts }}</p>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-500/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-tag class="w-5 h-5 text-purple-600" />
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">Categories</p>
                    <p class="text-2xl font-bold text-foreground">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>

        <!-- Impact Metrics -->
        <div class="bg-card border border-border rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-orange-500/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-chart-bar class="w-5 h-5 text-orange-600" />
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-muted-foreground">Metrics</p>
                    <p class="text-2xl font-bold text-foreground">{{ $totalMetrics }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Posts -->
        <div class="bg-card border border-border rounded-lg">
            <div class="px-6 py-4 border-b border-border">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-foreground">Recent Posts</h2>
                    <a href="{{ route('dashboard.posts.index') }}" 
                       class="text-sm text-primary hover:text-primary/80 transition-colors">
                        View all
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentPosts->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentPosts as $post)
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    @if($post->featured_image)
                                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" 
                                             class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center">
                                            <x-heroicon-o-document-text class="w-6 h-6 text-muted-foreground" />
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-foreground truncate">
                                        {{ $post->title }}
                                    </p>
                                    <p class="text-sm text-muted-foreground">
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        @if($post->is_published)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                Draft
                                            </span>
                                        @endif
                                        @if($post->category)
                                            <span class="ml-2 text-xs text-muted-foreground">
                                                {{ $post->category->name }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-muted-foreground" />
                        <h3 class="mt-2 text-sm font-medium text-foreground">No posts yet</h3>
                        <p class="mt-1 text-sm text-muted-foreground">Get started by creating your first post.</p>
                        <div class="mt-6">
                            <a href="{{ route('dashboard.posts.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                                New Post
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-card border border-border rounded-lg">
            <div class="px-6 py-4 border-b border-border">
                <h2 class="text-lg font-semibold text-foreground">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Create Post -->
                    <a href="{{ route('dashboard.posts.create') }}" 
                       class="group relative bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white hover:from-blue-600 hover:to-blue-700 transition-all">
                        <div class="flex items-center">
                            <x-heroicon-o-document-text class="w-8 h-8" />
                            <div class="ml-3">
                                <p class="text-sm font-medium">Create Post</p>
                                <p class="text-xs opacity-90">Write new content</p>
                            </div>
                        </div>
                    </a>

                    <!-- Manage Categories -->
                    <a href="{{ route('dashboard.categories.index') }}" 
                       class="group relative bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 text-white hover:from-purple-600 hover:to-purple-700 transition-all">
                        <div class="flex items-center">
                            <x-heroicon-o-tag class="w-8 h-8" />
                            <div class="ml-3">
                                <p class="text-sm font-medium">Categories</p>
                                <p class="text-xs opacity-90">Organize content</p>
                            </div>
                        </div>
                    </a>

                    <!-- Impact Metrics -->
                    <a href="{{ route('dashboard.metrics.index') }}" 
                       class="group relative bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white hover:from-green-600 hover:to-green-700 transition-all">
                        <div class="flex items-center">
                            <x-heroicon-o-chart-bar class="w-8 h-8" />
                            <div class="ml-3">
                                <p class="text-sm font-medium">Metrics</p>
                                <p class="text-xs opacity-90">Track impact</p>
                            </div>
                        </div>
                    </a>

                    <!-- View Site -->
                    <a href="{{ route('home') }}" target="_blank"
                       class="group relative bg-gradient-to-r from-gray-500 to-gray-600 rounded-lg p-4 text-white hover:from-gray-600 hover:to-gray-700 transition-all">
                        <div class="flex items-center">
                            <x-heroicon-o-eye class="w-8 h-8" />
                            <div class="ml-3">
                                <p class="text-sm font-medium">View Site</p>
                                <p class="text-xs opacity-90">Preview website</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
