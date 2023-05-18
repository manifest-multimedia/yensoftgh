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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->nullable();
            $table->foreignId('term_id')->constrained();
            $table->foreignId('academic_year_id')->constrained();
            $table->date('payment_date')->notNull();
            $table->string('description')->notNull();
            $table->decimal('amount', 10, 2)->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
