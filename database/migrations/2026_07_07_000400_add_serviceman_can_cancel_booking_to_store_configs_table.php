<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('store_configs', 'serviceman_can_cancel_booking')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->boolean('serviceman_can_cancel_booking')->default(false);
            });
        }
    }

    public function down(): void
    {
        foreach (['serviceman_can_cancel_booking'] as $column) {
            if (Schema::hasColumn('store_configs', $column)) {
                Schema::table('store_configs', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
