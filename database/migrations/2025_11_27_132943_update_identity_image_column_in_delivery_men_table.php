<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('delivery_men') && Schema::hasColumn('delivery_men', 'identity_image')) {
            // text: the column holds a JSON list of image names, which overflows varchar(255).
            DB::statement('ALTER TABLE delivery_men MODIFY identity_image TEXT NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('delivery_men') && Schema::hasColumn('delivery_men', 'identity_image')) {
            DB::statement('ALTER TABLE delivery_men MODIFY identity_image VARCHAR(255) NULL');
        }
    }
};
