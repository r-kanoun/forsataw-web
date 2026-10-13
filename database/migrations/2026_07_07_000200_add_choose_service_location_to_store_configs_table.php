<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('store_configs', 'choose_service_location')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->json('choose_service_location')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach (['choose_service_location'] as $column) {
            if (Schema::hasColumn('store_configs', $column)) {
                Schema::table('store_configs', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
