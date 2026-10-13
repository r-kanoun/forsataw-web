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

        if (!Schema::hasColumn('order_pro_discounts', 'service_booking_id')) {
            Schema::table('order_pro_discounts', function (Blueprint $table) {
                $table->unsignedBigInteger('service_booking_id')->nullable()->index();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('order_pro_discounts') && Schema::hasColumn('order_pro_discounts', 'service_booking_id')) {
            Schema::table('order_pro_discounts', function (Blueprint $table) {
                $table->dropIndex('order_pro_discounts_service_booking_id_index');
                $table->dropColumn('service_booking_id');
            });
        }
    }
};
