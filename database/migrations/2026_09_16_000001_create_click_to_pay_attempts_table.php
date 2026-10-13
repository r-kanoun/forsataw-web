<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('click_to_pay_attempts')) {
            return;
        }

        Schema::create('click_to_pay_attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('payment_request_id');
            $table->string('merchant_order_id', 32);
            $table->string('provider_order_id', 191)->nullable();
            $table->string('form_url', 500)->nullable();
            $table->string('status', 32)->default('created');
            $table->string('provider_status', 100)->nullable();
            $table->string('last_error', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('click_to_pay_attempts');
    }
};
