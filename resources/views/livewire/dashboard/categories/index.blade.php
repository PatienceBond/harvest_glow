<div>
    <!-- Page Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Categories</h1>
            <p class="mt-2 text-muted-foreground">
                Organize your posts with categories and tags.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <button wire:click="openCreate"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                New Category
            </button>
        </div>
    </div>

    <!-- Categories List Component -->
    <livewire:dashboard.categories.category-list :search="$search" />

    <!-- Create/Edit Modal -->
    @if($showCreateEdit)
        <div class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-card border border-border rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                <livewire:dashboard.categories.create-edit :categoryId="$editingCategoryId" />
            </div>
        </div>
    @endif

    <!-- View Modal -->
    @if($showView)
        <div class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-card border border-border rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                <livewire:dashboard.categories.view :categoryId="$viewingCategoryId" />
            </div>
        </div>
    @endif

</div>
