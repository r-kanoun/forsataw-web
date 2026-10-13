<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('customer_preference_summaries')) {
            return;
        }

        foreach (['keyword_item_ids', 'keyword_category_ids', 'keyword_store_ids'] as $column) {
            if (!Schema::hasColumn('customer_preference_summaries', $column)) {
                Schema::table('customer_preference_summaries', function (Blueprint $table) use ($column) {
                    $table->json($column)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['keyword_item_ids', 'keyword_category_ids', 'keyword_store_ids'] as $column) {
            if (Schema::hasTable('customer_preference_summaries') && Schema::hasColumn('customer_preference_summaries', $column)) {
                Schema::table('customer_preference_summaries', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
