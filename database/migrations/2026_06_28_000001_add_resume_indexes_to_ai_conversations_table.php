<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ai_conversations')) {
            return;
        }

        if (!Schema::hasIndex('ai_conversations', 'ai_conv_user_resume_idx')) {
            Schema::table('ai_conversations', function (Blueprint $table) {
                $table->index(['user_id', 'status', 'module_id', 'zone_id', 'updated_at'], 'ai_conv_user_resume_idx');
            });
        }

        if (!Schema::hasIndex('ai_conversations', 'ai_conv_guest_resume_idx')) {
            Schema::table('ai_conversations', function (Blueprint $table) {
                $table->index(['guest_id', 'status', 'module_id', 'zone_id', 'updated_at'], 'ai_conv_guest_resume_idx');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('ai_conversations')) {
            return;
        }

        foreach (['ai_conv_user_resume_idx', 'ai_conv_guest_resume_idx'] as $index) {
            if (Schema::hasIndex('ai_conversations', $index)) {
                Schema::table('ai_conversations', function (Blueprint $table) use ($index) {
                    $table->dropIndex($index);
                });
            }
        }
    }
};
