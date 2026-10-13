<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('temp_products')) {
            return;
        }

        foreach (['available_date_starts', 'available_date_ends'] as $column) {
            if (!Schema::hasColumn('temp_products', $column)) {
                Schema::table('temp_products', function (Blueprint $table) use ($column) {
                    $table->date($column)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['available_date_starts', 'available_date_ends'] as $column) {
            if (Schema::hasColumn('temp_products', $column)) {
                Schema::table('temp_products', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
