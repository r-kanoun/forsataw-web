<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('event_registrations', 'ticket_mail_sent_at')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->timestamp('ticket_mail_sent_at')->nullable()->after('account_mail_sent_at');
            });
        }
    }

    public function down(): void
    {
        foreach (['ticket_mail_sent_at'] as $column) {
            if (Schema::hasColumn('event_registrations', $column)) {
                Schema::table('event_registrations', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
