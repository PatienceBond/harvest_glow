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
            <flux:modal.trigger name="create-category">
                <flux:button icon="plus">New Category</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <!-- Categories List Component -->
    <livewire:dashboard.categories.category-list :search="$search" :key="'category-list'" />

    <!-- Create/Edit Modal - Using Flux Native Modal -->
    <flux:modal name="create-category" class="md:w-96" wire:model="showCreateEdit">
        @if($showCreateEdit)
            <livewire:dashboard.categories.create-edit :categoryId="$editingCategoryId" :key="'create-edit-'.($editingCategoryId ?? 'new')" />
        @endif
    </flux:modal>

    <!-- View Modal - Using Flux Native Modal -->
    <flux:modal name="view-category" class="md:w-96" wire:model="showView">
        @if($showView)
            <livewire:dashboard.categories.view :categoryId="$viewingCategoryId" :key="'view-'.$viewingCategoryId" />
        @endif
    </flux:modal>
</div>