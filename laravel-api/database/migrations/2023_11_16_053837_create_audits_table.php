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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->text('ip')->nullable();
            $table->text('url')->nullable();
            $table->text('device')->nullable();
            $table->text('platform')->nullable();
            $table->text('browser')->nullable();
            $table->text('version')->nullable();
            $table->tinyInteger('is_desktop')->default(0);
            $table->tinyInteger('is_phone')->default(0);
            $table->tinyInteger('is_table')->default(0);
            $table->tinyInteger('is_robot')->default(0);
            $table->text('robot_name')->nullable();
            $table->tinyInteger('is_login')->default(0);
            $table->text('login_time')->nullable();
            $table->text('logout_time')->nullable();
            $table->text('last_time_used')->nullable();
            $table->bigInteger('user_id')->default(0);
            $table->text('username')->nullable();
            $table->text('password')->nullable();
            $table->tinyInteger('is_no_auth')->default(0);
            $table->tinyInteger('is_no_permission')->default(0);
            $table->tinyInteger('is_view')->default(0);
            $table->tinyInteger('is_create')->default(0);
            $table->tinyInteger('is_edit')->default(0);
            $table->tinyInteger('is_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
