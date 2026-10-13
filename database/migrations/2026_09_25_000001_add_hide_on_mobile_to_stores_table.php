<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('stores', 'hide_on_mobile')) {
            Schema::table('stores', function (Blueprint $table) {
                $table->boolean('hide_on_mobile')->default(false);
            });
        }
    }

    public function down(): void
    {
        foreach (['hide_on_mobile'] as $column) {
            if (Schema::hasColumn('stores', $column)) {
                Schema::table('stores', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
