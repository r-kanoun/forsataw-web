<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The vendors.bank_name column is reused to store the reason a vendor application was rejected.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('vendors') || Schema::hasColumn('vendors', 'rejection_note')) {
            return;
        }

        if (Schema::hasColumn('vendors', 'bank_name')) {
            DB::statement('ALTER TABLE vendors CHANGE bank_name rejection_note TEXT NULL');
        } else {
            Schema::table('vendors', function (Blueprint $table) {
                $table->text('rejection_note')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('vendors') && Schema::hasColumn('vendors', 'rejection_note') && !Schema::hasColumn('vendors', 'bank_name')) {
            DB::statement('ALTER TABLE vendors CHANGE rejection_note bank_name VARCHAR(255) NULL');
        }
    }
};
