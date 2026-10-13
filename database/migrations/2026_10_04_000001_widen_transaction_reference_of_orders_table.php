<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Payment-request ids (UUIDs) and gateway references are longer than the original 30 characters.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'transaction_reference')) {
            DB::statement('ALTER TABLE orders MODIFY transaction_reference VARCHAR(191) NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'transaction_reference')) {
            DB::statement('UPDATE orders SET transaction_reference = LEFT(transaction_reference, 30) WHERE CHAR_LENGTH(transaction_reference) > 30');
            DB::statement('ALTER TABLE orders MODIFY transaction_reference VARCHAR(30) NULL');
        }
    }
};
