<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('items', 'available_date_starts')) {
            Schema::table('items', function (Blueprint $table) {
                $table->date('available_date_starts')->nullable();
            });
        }

        if (!Schema::hasColumn('items', 'available_date_ends')) {
            Schema::table('items', function (Blueprint $table) {
                $table->date('available_date_ends')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach (['available_date_starts', 'available_date_ends'] as $column) {
            if (Schema::hasColumn('items', $column)) {
                Schema::table('items', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
