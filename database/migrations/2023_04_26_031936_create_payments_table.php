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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->string('serial_number')->nullable();
            $table->integer('term')->notNull();
            $table->date('payment_date')->notNull();
            $table->decimal('amount', 10, 2)->notNull();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('billing_id')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('mode')->nullable();
            $table->foreign('student_id')->references('id') ->on('students')->onDelete('set null');
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
