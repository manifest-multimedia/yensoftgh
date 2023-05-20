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
        Schema::create('billings', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('student_id');
            $table->integer('term')->notNullable();
            $table->date('billing_date')->notNullable();
            $table->decimal('amount', 10, 2)->notNullable();
            $table->string('description')->nullable();
            $table->string('serial_number')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('academic_year_id')->notNullable();
            $table->integer('status')->default(1); // 1 unpaid, 2 partial, 3 paid
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
