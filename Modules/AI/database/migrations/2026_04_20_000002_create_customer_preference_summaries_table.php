<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('customer_preference_summaries')) {
            return;
        }

        Schema::create('customer_preference_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->json('top_items')->nullable();
            $table->json('top_categories')->nullable();
            $table->json('top_stores')->nullable();
            $table->json('ai_keywords')->nullable();
            $table->unsignedInteger('update_count')->default(0)->index('cps_update_count_index');
            $table->timestamp('last_rebuilt_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'module_id'], 'cps_user_module_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_preference_summaries');
    }
};
