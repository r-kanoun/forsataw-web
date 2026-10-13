<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_registrations')) {
            return;
        }

        if (!Schema::hasColumn('event_registrations', 'ticket_code')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->string('ticket_code', 64)->nullable()->unique()->after('access_token_hash');
            });
        }

        if (!Schema::hasColumn('event_registrations', 'ticket_generated_at')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->timestamp('ticket_generated_at')->nullable()->after('ticket_code');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('event_registrations')) {
            return;
        }

        if (Schema::hasIndex('event_registrations', 'event_registrations_ticket_code_unique')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->dropUnique('event_registrations_ticket_code_unique');
            });
        }

        foreach (['ticket_code', 'ticket_generated_at'] as $column) {
            if (Schema::hasColumn('event_registrations', $column)) {
                Schema::table('event_registrations', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
