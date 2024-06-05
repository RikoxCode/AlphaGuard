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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->string('message');
            $table->string('context');
            $table->string('location_continent');
            $table->string('location_country');
            $table->string('location_iso_code');
            $table->string('location_city');
            $table->string('user_agent');
            $table->string('user_id');
            $table->string('url');
            $table->string('method');
            $table->string('input');
            $table->text('response');
            $table->string('status_code');
            $table->string('response_time');
            $table->string('response_size');
            $table->string('response_headers');
            $table->string('request_headers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
