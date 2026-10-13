<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_registrations') || !Schema::hasTable('orders')) {
            return;
        }

        DB::table('orders')
            ->whereIn('id', DB::table('event_registrations')->select('order_id'))
            ->whereNull('schedule_at')
            ->update(['schedule_at' => DB::raw('created_at')]);
    }

    public function down(): void
    {
        // Data backfill only; nothing to undo.
    }
};
