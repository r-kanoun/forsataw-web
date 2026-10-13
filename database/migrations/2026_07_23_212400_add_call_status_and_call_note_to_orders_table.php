<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('orders', 'call_status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('call_status', 30)->default('not_called');
            });
        }

        if (!Schema::hasColumn('orders', 'call_note')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('call_note')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach (['call_status', 'call_note'] as $column) {
            if (Schema::hasColumn('orders', $column)) {
                Schema::table('orders', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
