<div>
     <!-- Page Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-normal text-foreground">Categories</h1>
            <p class="mt-1 text-xs text-muted-foreground">
                Organize your posts with categories and tags.
            </p>
        </div>
       
    </div>
    <!-- Page Header -->
    <livewire:dashboard.categories.category-list :key="'category-list'" />

  
</div>