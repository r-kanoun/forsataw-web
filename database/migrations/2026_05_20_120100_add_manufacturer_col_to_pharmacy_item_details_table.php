<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('pharmacy_item_details', 'manufacturer')) {
            Schema::table('pharmacy_item_details', function (Blueprint $table) {
                $table->string('manufacturer')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach (['manufacturer'] as $column) {
            if (Schema::hasColumn('pharmacy_item_details', $column)) {
                Schema::table('pharmacy_item_details', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
