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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            // $table->foreignId('level_id')->nullable()->constrained();
            $table->unsignedInteger('level_id')->nullable();
            $table->foreignId('term_id')->constrained();
            $table->foreignId('academic_year_id')->constrained();
            $table->date('exercise_date');
            $table->float('score');
            $table->float('max_score');
            $table->timestamps();

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
        });
            }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
