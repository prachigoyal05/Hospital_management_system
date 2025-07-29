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
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
           $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('turnaround_time', 8, 2)->nullable();
            $table->text('test_requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};
