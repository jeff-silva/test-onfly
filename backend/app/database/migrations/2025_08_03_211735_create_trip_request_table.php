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
        Schema::create('trip_request', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('destination')->nullable();
            $table->string('departure_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('user_id')->constrained('app_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_request');
    }
};
