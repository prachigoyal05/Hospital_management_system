<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('samples', function (Blueprint $table) {
        $table->id();
        // $table->string('sample_id')->unique(); // If you want a unique sample code
        $table->string('sample_type');
        $table->string('test_type');
        $table->date('collection_date');
        $table->date('submission_date');
        $table->string('status')->default('Pending');
        $table->unsignedBigInteger('collected_by')->nullable(); // FK to users table
        $table->text('results')->nullable();
        $table->timestamps();

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples');
    }
};
