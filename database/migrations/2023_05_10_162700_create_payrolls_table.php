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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->constrained('staff');
            $table->date('month');
            $table->year('year');
            $table->decimal('gross_salary')->nullable();
            $table->decimal('basic_salary')->nullable();
            $table->decimal('allowances')->nullable();
            $table->decimal('employee_contribution')->nullable();
            $table->decimal('taxable_income')->nullable();
            $table->decimal('tax_amount')->nullable();
            $table->decimal('other_deductions')->nullable();
            $table->decimal('net_salary')->nullable();
            $table->unsignedBigInteger('social_security_id')->constrained('social_securities');
            $table->unsignedBigInteger('staff_tax_id')->nullable()->constrained('staff_taxes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
