<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('vendor_employees', 'login_remember_token')) {
            Schema::table('vendor_employees', function (Blueprint $table) {
                $table->string('login_remember_token')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach (['login_remember_token'] as $column) {
            if (Schema::hasColumn('vendor_employees', $column)) {
                Schema::table('vendor_employees', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
