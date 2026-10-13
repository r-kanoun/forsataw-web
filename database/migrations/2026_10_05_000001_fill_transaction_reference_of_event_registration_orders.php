<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Event orders without a transaction reference fall back to the registration reference.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_registrations') || !Schema::hasTable('orders')) {
            return;
        }

        DB::table('event_registrations')
            ->join('orders', 'orders.id', '=', 'event_registrations.order_id')
            ->where(function ($query) {
                $query->whereNull('orders.transaction_reference')->orWhere('orders.transaction_reference', '');
            })
            ->whereNotNull('event_registrations.reference')
            ->select('orders.id as order_id', 'event_registrations.reference')
            ->orderBy('orders.id')
            ->each(function ($row) {
                DB::table('orders')->where('id', $row->order_id)->update(['transaction_reference' => $row->reference]);
            });
    }

    public function down(): void
    {
        // Data backfill only; nothing to undo.
    }
};
