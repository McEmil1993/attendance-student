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
        Schema::create('handle_students', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('student_id');

            // Room assign
            $table->string('room_assign', 100);

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('instructor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('handle_students');
    }
};
