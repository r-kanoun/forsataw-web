<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Code and the tax setup screen use 'service_provider'; older rows may still hold 'service_tax_payer'.
 */
return new class extends Migration
{
    public function up(): void
    {
        foreach (['system_tax_setups', 'order_taxes'] as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'tax_payer')) {
                DB::table($tableName)->where('tax_payer', 'service_tax_payer')->update(['tax_payer' => 'service_provider']);
            }
        }
    }

    public function down(): void
    {
        foreach (['system_tax_setups', 'order_taxes'] as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'tax_payer')) {
                DB::table($tableName)->where('tax_payer', 'service_provider')->update(['tax_payer' => 'service_tax_payer']);
            }
        }
    }
};
