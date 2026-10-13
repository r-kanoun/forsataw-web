<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Deliveryman loyalty points and referral code / referrer (used by DeliveryMan and the loyalty/referral histories).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('delivery_men', 'loyalty_point')) {
            Schema::table('delivery_men', function (Blueprint $table) {
                $table->double('loyalty_point')->default(0)->nullable();
            });
        }

        if (!Schema::hasColumn('delivery_men', 'ref_code')) {
            Schema::table('delivery_men', function (Blueprint $table) {
                $table->string('ref_code')->nullable();
            });
        }

        if (!Schema::hasColumn('delivery_men', 'ref_by')) {
            Schema::table('delivery_men', function (Blueprint $table) {
                $table->unsignedBigInteger('ref_by')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach (['loyalty_point', 'ref_code', 'ref_by'] as $column) {
            if (Schema::hasColumn('delivery_men', $column)) {
                Schema::table('delivery_men', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
