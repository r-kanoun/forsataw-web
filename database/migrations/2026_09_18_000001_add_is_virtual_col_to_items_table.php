<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('items', 'is_virtual')) {
            Schema::table('items', function (Blueprint $table) {
                $table->boolean('is_virtual')->default(false);
            });
        }
    }

    public function down(): void
    {
        foreach (['is_virtual'] as $column) {
            if (Schema::hasColumn('items', $column)) {
                Schema::table('items', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
