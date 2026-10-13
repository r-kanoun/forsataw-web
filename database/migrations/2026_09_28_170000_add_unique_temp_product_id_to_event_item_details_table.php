<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * One pending (temp) product maps to at most one set of event details.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_item_details')) {
            return;
        }

        if (!Schema::hasIndex('event_item_details', 'event_item_details_temp_product_id_unique')) {
            Schema::table('event_item_details', function (Blueprint $table) {
                $table->unique('temp_product_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('event_item_details')
            && Schema::hasIndex('event_item_details', 'event_item_details_temp_product_id_unique')) {
            Schema::table('event_item_details', function (Blueprint $table) {
                $table->dropUnique('event_item_details_temp_product_id_unique');
            });
        }
    }
};
