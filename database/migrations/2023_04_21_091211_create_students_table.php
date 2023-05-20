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
        Schema::create('students', function (Blueprint $table) {
            $table->id('id');
            $table->string('serial_id')->unique()->nullable();
            $table->string('surname');
            $table->string('othername');
            $table->unsignedBigInteger('gender')->default(1)->nullable(); //1-male, 2-female
            $table->date('dob');
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('hometown')->nullable();
            $table->string('district')->nullable();
            $table->string('region')->nullable();
            $table->string('parent_name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('lastschool')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('lastclass')->nullable();
            $table->unsignedInteger('level_id')->nullable();
            $table->unsignedBigInteger('status')->default(1); //1-active 3-withdrawn 2-graduate
            $table->timestamps();
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
            $table->foreign('lastclass')->references('id')->on('levels')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
