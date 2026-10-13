<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('event_registrations')) {
            return;
        }

        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 32)->nullable()->unique();
            $table->char('access_token_hash', 64)->nullable();
            $table->unsignedBigInteger('order_id')->unique();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('store_id')->index();
            $table->unsignedBigInteger('item_id');
            $table->string('full_name', 191);
            $table->string('email', 100)->index();
            $table->string('phone', 20);
            $table->date('birth_date');
            $table->string('gender', 10);
            $table->string('nationality', 5);
            $table->string('id_type', 10);
            $table->string('id_number', 20);
            $table->string('club', 191)->nullable();
            $table->boolean('championship')->default(false);
            $table->string('license_number', 50)->nullable();
            $table->string('license_scan_path')->nullable();
            $table->unsignedTinyInteger('age_on_event_day');
            $table->timestamp('conditions_accepted_at');
            $table->string('conditions_version', 20)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('place_released_at')->nullable();
            $table->string('active_key', 64)->nullable()->unique();
            $table->timestamps();

            $table->index(['item_id', 'id_type', 'id_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
