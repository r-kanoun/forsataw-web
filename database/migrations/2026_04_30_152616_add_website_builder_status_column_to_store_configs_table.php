<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('store_configs', 'website_builder_status')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->integer('website_builder_status')->default(0);
            });
        }
    }

    public function down(): void
    {
        foreach (['website_builder_status'] as $column) {
            if (Schema::hasColumn('store_configs', $column)) {
                Schema::table('store_configs', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
