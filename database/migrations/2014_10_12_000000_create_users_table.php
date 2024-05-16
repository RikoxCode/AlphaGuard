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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->binary('avatar')->nullable();
            $table->string('nickname')->nullable();
            $table->string('email')->unique();
            $table->string('bio')->nullable();
            $table->integer('permissions_level')->default(0);
            $table->boolean('is_sys_admin')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->string('blocked_reason')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
