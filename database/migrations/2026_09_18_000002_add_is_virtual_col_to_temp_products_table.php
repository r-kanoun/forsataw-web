<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('temp_products', 'is_virtual')) {
            Schema::table('temp_products', function (Blueprint $table) {
                $table->boolean('is_virtual')->default(false);
            });
        }
    }

    public function down(): void
    {
        foreach (['is_virtual'] as $column) {
            if (Schema::hasColumn('temp_products', $column)) {
                Schema::table('temp_products', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
