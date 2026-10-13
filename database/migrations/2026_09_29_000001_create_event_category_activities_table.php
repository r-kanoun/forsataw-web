<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('event_category_activities')) {
            return;
        }

        Schema::create('event_category_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->unique();
            $table->string('activity', 30);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_category_activities');
    }
};
