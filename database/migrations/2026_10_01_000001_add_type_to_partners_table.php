<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('partners')) {
            return;
        }

        if (!Schema::hasColumn('partners', 'type')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->string('type', 20)->default('partner')->after('store_id');
            });
        }

        if (!Schema::hasIndex('partners', 'partners_type_index')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->index('type');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('partners') && Schema::hasColumn('partners', 'type')) {
            Schema::table('partners', function (Blueprint $table) {
                if (Schema::hasIndex('partners', 'partners_type_index')) {
                    $table->dropIndex('partners_type_index');
                }
                $table->dropColumn('type');
            });
        }
    }
};
