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
        Schema::table('users', function (Blueprint $table) {
            // Add status for user approval (e.g., 'pending', 'approved', 'rejected')
            $table->string('status')->default('pending')->after('password');
            // Add phone number for M-Pesa and contact
            $table->string('phone')->nullable()->after('email');
            // Add graduation year for alumni profiles
            $table->integer('graduation_year')->nullable()->after('phone');
            // Add profile photo path
            $table->string('profile_photo_path', 2048)->nullable()->after('graduation_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status', 'phone', 'graduation_year', 'profile_photo_path']);
        });
    }
};
