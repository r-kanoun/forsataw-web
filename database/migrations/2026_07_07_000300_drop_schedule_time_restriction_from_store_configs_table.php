<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('store_configs') && Schema::hasColumn('store_configs', 'schedule_time_restriction')) {
            Schema::table('store_configs', function (Blueprint $table) {
                $table->dropColumn('schedule_time_restriction');
            });
        }
    }

    public function down(): void
    {
        // The column was never part of a released schema; nothing to restore.
    }
};
