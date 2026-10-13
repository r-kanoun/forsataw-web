<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('module_zone', 'additional_delivery_option_status')) {
            Schema::table('module_zone', function (Blueprint $table) {
                $table->boolean('additional_delivery_option_status')->default(false);
            });
        }

        if (!Schema::hasColumn('module_zone', 'minimum_delivery_time')) {
            Schema::table('module_zone', function (Blueprint $table) {
                $table->integer('minimum_delivery_time')->nullable();
            });
        }

        if (!Schema::hasColumn('module_zone', 'minimum_delivery_charge')) {
            Schema::table('module_zone', function (Blueprint $table) {
                $table->decimal('minimum_delivery_charge', 10, 4)->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach (['additional_delivery_option_status', 'minimum_delivery_time', 'minimum_delivery_charge'] as $column) {
            if (Schema::hasColumn('module_zone', $column)) {
                Schema::table('module_zone', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
