<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['items', 'temp_products'] as $tableName) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            if (!Schema::hasColumn($tableName, 'video')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->string('video', 191)->nullable();
                });
            }

            if (!Schema::hasColumn($tableName, 'video_link')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->text('video_link')->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['items', 'temp_products'] as $tableName) {
            foreach (['video', 'video_link'] as $column) {
                if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, $column)) {
                    Schema::table($tableName, function (Blueprint $table) use ($column) {
                        $table->dropColumn($column);
                    });
                }
            }
        }
    }
};
