<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('event_registrations', 'message_sent_at')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->timestamp('message_sent_at')->nullable()->after('ticket_mail_sent_at');
            });
        }
    }

    public function down(): void
    {
        foreach (['message_sent_at'] as $column) {
            if (Schema::hasColumn('event_registrations', $column)) {
                Schema::table('event_registrations', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
