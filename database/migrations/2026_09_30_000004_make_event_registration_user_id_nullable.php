<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * A registration can now be made without an account (the account is created and mailed afterwards).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('event_registrations') && Schema::hasColumn('event_registrations', 'user_id')) {
            DB::statement('ALTER TABLE event_registrations MODIFY user_id BIGINT UNSIGNED NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('event_registrations') && Schema::hasColumn('event_registrations', 'user_id')) {
            // Registrations made without an account have no user to point at; they cannot satisfy NOT NULL.
            if (DB::table('event_registrations')->whereNull('user_id')->exists()) {
                return;
            }
            DB::statement('ALTER TABLE event_registrations MODIFY user_id BIGINT UNSIGNED NOT NULL');
        }
    }
};
