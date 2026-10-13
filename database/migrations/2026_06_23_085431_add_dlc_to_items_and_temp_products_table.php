<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * dlc = date limite de consommation (best-before date) of an item / pending item.
 */
return new class extends Migration
{
    public function up(): void
    {
        foreach (['items', 'temp_products'] as $tableName) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'dlc')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->date('dlc')->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['items', 'temp_products'] as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'dlc')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('dlc');
                });
            }
        }
    }
};
