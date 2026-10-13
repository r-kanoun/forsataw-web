<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('data_settings')) {
            return;
        }

        $exists = DB::table('data_settings')
            ->where('key', 'event_planner_login_url')
            ->where('type', 'login_event_planner')
            ->exists();

        if (!$exists) {
            DB::table('data_settings')->insert([
                'key' => 'event_planner_login_url',
                'value' => 'event-planner',
                'type' => 'login_event_planner',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('data_settings')) {
            DB::table('data_settings')
                ->where('key', 'event_planner_login_url')
                ->where('type', 'login_event_planner')
                ->delete();
        }
    }
};
