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
            if (!Schema::hasColumn('m_pesa_donations', 'checkout_request_id')) {
                $table->string('checkout_request_id')->nullable()->after('transaction_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_pesa_donations', function (Blueprint $table) {
            if (Schema::hasColumn('m_pesa_donations', 'checkout_request_id')) {
                $table->dropColumn('checkout_request_id');
            }
        });
    }
};
