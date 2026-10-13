<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('store_configs', 'can_edit_booking')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->boolean('can_edit_booking')->default(false);
            });
        }

        if (!Schema::hasColumn('store_configs', 'instant_booking')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->boolean('instant_booking')->default(true);
            });
        }

        if (!Schema::hasColumn('store_configs', 'repeat_booking')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->boolean('repeat_booking')->default(false);
            });
        }

        if (!Schema::hasColumn('store_configs', 'schedule_booking')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->boolean('schedule_booking')->default(true);
            });
        }
    }

    public function down(): void
    {
        foreach (['can_edit_booking', 'instant_booking', 'repeat_booking', 'schedule_booking'] as $column) {
            if (Schema::hasColumn('store_configs', $column)) {
                Schema::table('store_configs', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
