<div x-data="{ showModal: @entangle('showCreateEdit'), showViewModal: @entangle('showView') }">
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
    <livewire:dashboard.categories.category-list :search="$search" :key="'category-list'" />

    <!-- Create/Edit Modal -->
    <div x-show="showModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
         @click.self="$wire.closeModal()">
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-card border border-border rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto"
             @click.stop>
            @if($showCreateEdit)
                <livewire:dashboard.categories.create-edit :categoryId="$editingCategoryId" :key="'create-edit-'.($editingCategoryId ?? 'new')" />
            @endif
        </div>
    </div>

    <!-- View Modal -->
    <div x-show="showViewModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
         @click.self="$wire.closeModal()">
        <div x-show="showViewModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-card border border-border rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto"
             @click.stop>
            @if($showView)
                <livewire:dashboard.categories.view :categoryId="$viewingCategoryId" :key="'view-'.$viewingCategoryId" />
            @endif
        </div>
    </div>

</div>