<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('bio')->nullable();
            
            // Settings fields
            $table->boolean('email_notifications')->default(true);
            $table->boolean('event_reminders')->default(true);
            $table->boolean('newsletter')->default(false);
            $table->enum('profile_visibility', ['public', 'alumni', 'private'])->default('public');
            $table->boolean('contact_visible')->default(true);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'bio', 
                'email_notifications', 'event_reminders', 
                'newsletter', 'profile_visibility', 'contact_visible'
            ]);
        });
    }
};
