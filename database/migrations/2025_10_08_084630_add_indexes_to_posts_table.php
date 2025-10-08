<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add index on is_published for filtering published posts
            $table->index('is_published');
            
            // Add index on published_at for sorting by publish date
            $table->index('published_at');
            
            // Add composite index for common query pattern (is_published + published_at)
            $table->index(['is_published', 'published_at'], 'posts_published_date_index');
            
            // Add index on slug for looking up posts by slug (already unique, but index helps)
            // Unique constraint already creates an index, so we don't need to add it separately
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop indexes in reverse order
            $table->dropIndex('posts_published_date_index');
            $table->dropIndex(['published_at']);
            $table->dropIndex(['is_published']);
        });
    }
};
