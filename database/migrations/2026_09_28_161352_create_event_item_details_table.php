<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('event_item_details')) {
            return;
        }

        Schema::create('event_item_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable()->unique();
            $table->unsignedBigInteger('temp_product_id')->nullable();
            $table->string('activity', 30);
            $table->json('attributes');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
            $table->foreign('temp_product_id')->references('id')->on('temp_products')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_item_details');
    }
};
