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
        Schema::create('profile_logs', function (Blueprint $table) {
            $table->id();
            $table->string('id_number', 50)->nullable();
            $table->string('fullname', 150)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('device_type', 20)->nullable(); // Mobile, Desktop, Tablet
            $table->string('lat_long', 50)->nullable();
            $table->enum('status', ['Success', 'Failed'])->default('Failed');
            $table->integer('attempt_count')->default(1);
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_logs');
    }
};
