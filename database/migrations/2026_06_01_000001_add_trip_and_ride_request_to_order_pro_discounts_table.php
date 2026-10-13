<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('order_pro_discounts')) {
            return;
        }

        foreach (['trip_id', 'ride_request_id'] as $column) {
            if (!Schema::hasColumn('order_pro_discounts', $column)) {
                Schema::table('order_pro_discounts', function (Blueprint $table) use ($column) {
                    $table->unsignedBigInteger($column)->nullable()->index();
                });
            }
        }

        // Trip and ride-request discounts have no order behind them.
        DB::statement('ALTER TABLE order_pro_discounts MODIFY order_id BIGINT UNSIGNED NULL');
    }

    public function down(): void
    {
        if (!Schema::hasTable('order_pro_discounts')) {
            return;
        }

        foreach (['trip_id', 'ride_request_id'] as $column) {
            if (Schema::hasColumn('order_pro_discounts', $column)) {
                Schema::table('order_pro_discounts', function (Blueprint $table) use ($column) {
                    $table->dropIndex('order_pro_discounts_' . $column . '_index');
                    $table->dropColumn($column);
                });
            }
        }
    }
};
