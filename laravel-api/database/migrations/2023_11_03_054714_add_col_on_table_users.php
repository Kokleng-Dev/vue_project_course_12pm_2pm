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
            $table->tinyInteger('is_two_factor')->default(0)->comment('0: no, 1: yes');
            $table->string('otp')->nullable();
            $table->text('photo')->nullable();
            $table->bigInteger('role_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_two_factor');
            $table->dropColumn('photo');
            $table->dropColumn('otp');
            $table->dropColumn('role_id');
        });
    }
};
