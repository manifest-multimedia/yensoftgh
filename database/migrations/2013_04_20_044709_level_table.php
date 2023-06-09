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
        Schema::dropIfExists('levels');

        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('abbre'); //BS1
            $table->string('name'); //Basic One
            $table->unsignedBigInteger('department_id')->nullable();
            $table->timestamps();
        });

        Schema::table('levels', function (Blueprint $table) {
            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('levels');
    }
};