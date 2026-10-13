<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Orders created by an event registration carry no delivery address; give them the registrant's contact details
 * so order screens that read contact_person_* do not break.
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
                $query->whereNull('orders.delivery_address')->orWhere('orders.delivery_address', '');
            })
            ->select('orders.id as order_id', 'event_registrations.full_name', 'event_registrations.phone', 'event_registrations.email')
            ->orderBy('orders.id')
            ->each(function ($row) {
                DB::table('orders')->where('id', $row->order_id)->update([
                    'delivery_address' => json_encode([
                        'contact_person_name' => $row->full_name,
                        'contact_person_number' => $row->phone,
                        'contact_person_email' => $row->email,
                        'address_type' => 'others',
                        'address' => '',
                        'floor' => '',
                        'road' => '',
                        'house' => '',
                        'longitude' => '',
                        'latitude' => '',
                    ]),
                ]);
            });
    }

    public function down(): void
    {
        // Data backfill only; nothing to undo.
    }
};
