<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('enda_tao_attempts')) {
            return;
        }

        Schema::create('enda_tao_attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('payment_request_id');
            $table->string('merchant_reference', 100);
            $table->string('provider_transaction_id', 191)->nullable();
            $table->string('status', 32)->default('created');
            $table->string('provider_status', 100)->nullable();
            $table->unsignedSmallInteger('otp_attempts')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->string('last_error', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enda_tao_attempts');
    }
};
