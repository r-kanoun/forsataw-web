<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLES = ['module_wise_banners'];

    public function up(): void
    {
        foreach (self::TABLES as $tableName) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            if (!Schema::hasColumn($tableName, 'store_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->unsignedBigInteger('store_id')->nullable();
                });
            }

            if (!Schema::hasIndex($tableName, $tableName . '_store_id_index')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->index('store_id');
                });
            }
        }
    }

    public function down(): void
    {
        foreach (self::TABLES as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'store_id')) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (Schema::hasIndex($tableName, $tableName . '_store_id_index')) {
                        $table->dropIndex($tableName . '_store_id_index');
                    }
                    $table->dropColumn('store_id');
                });
            }
        }
    }
};
