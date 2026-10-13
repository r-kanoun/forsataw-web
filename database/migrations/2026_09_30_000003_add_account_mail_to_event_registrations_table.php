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

        if (!Schema::hasColumn('event_registrations', 'account_password')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                // Encrypted by the application: it is mailed once to the account created for the registrant.
                $table->text('account_password')->nullable()->after('ticket_generated_at');
            });
        }

        if (!Schema::hasColumn('event_registrations', 'account_mail_sent_at')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->timestamp('account_mail_sent_at')->nullable()->after('account_password');
            });
        }
    }

    public function down(): void
    {
        foreach (['account_password', 'account_mail_sent_at'] as $column) {
            if (Schema::hasTable('event_registrations') && Schema::hasColumn('event_registrations', $column)) {
                Schema::table('event_registrations', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
