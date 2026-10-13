<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('store_configs', 'manage_service_setup')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->boolean('manage_service_setup')->default(true);
            });
        }

        if (!Schema::hasColumn('store_configs', 'show_reviews_provider_panel')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->boolean('show_reviews_provider_panel')->default(true);
            });
        }

        if (!Schema::hasColumn('store_configs', 'minimum_booking')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->decimal('minimum_booking', 24, 2)->default(0);
            });
        }
    }

    public function down(): void
    {
        foreach (['manage_service_setup', 'show_reviews_provider_panel', 'minimum_booking'] as $column) {
            if (Schema::hasColumn('store_configs', $column)) {
                Schema::table('store_configs', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
