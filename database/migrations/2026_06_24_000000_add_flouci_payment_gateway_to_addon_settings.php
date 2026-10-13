<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Registers the Flouci gateway disabled and without credentials: the admin enters them from
 * Business Settings > Payment Methods. A row that already exists (and its credentials) is left alone.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('addon_settings')) {
            return;
        }

        $exists = DB::table('addon_settings')
            ->where('key_name', 'flouci')
            ->where('settings_type', 'payment_config')
            ->exists();

        if ($exists) {
            return;
        }

        $values = json_encode([
            'gateway' => 'flouci',
            'mode' => 'test',
            'status' => '0',
            'callback_url' => '',
            'public_key' => '',
            'secret_key' => '',
            'accept_card' => '1',
        ]);

        DB::table('addon_settings')->insert([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'key_name' => 'flouci',
            'live_values' => $values,
            'test_values' => $values,
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => 0,
            'additional_data' => json_encode(['gateway_title' => 'Flouci', 'gateway_image' => '']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (Schema::hasTable('addon_settings')) {
            DB::table('addon_settings')
                ->where('key_name', 'flouci')
                ->where('settings_type', 'payment_config')
                ->delete();
        }
    }
};
