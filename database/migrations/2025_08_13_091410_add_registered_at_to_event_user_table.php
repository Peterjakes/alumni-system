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
    Schema::table('event_user', function (Blueprint $table) {
        $table->timestamp('registered_at')->nullable()->after('user_id');
    });
}

public function down(): void
{
    Schema::table('event_user', function (Blueprint $table) {
        $table->dropColumn('registered_at');
    });
}


};
