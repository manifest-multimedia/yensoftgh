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
        Schema::create('staff_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->foreignId('staff_id')->constrained('staff');
            $table->decimal('basic_salary')->nullable();
            $table->decimal('allowances')->nullable();
            $table->decimal('taxable_income')->nullable();
            $table->decimal('tax_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_taxes');
    }
};
