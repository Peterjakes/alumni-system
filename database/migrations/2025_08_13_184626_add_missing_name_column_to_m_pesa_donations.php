<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('m_pesa_donations', function (Blueprint $table) {
            if (!Schema::hasColumn('m_pesa_donations', 'name')) {
                $table->string('name')->nullable()->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_pesa_donations', function (Blueprint $table) {
            if (Schema::hasColumn('m_pesa_donations', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
