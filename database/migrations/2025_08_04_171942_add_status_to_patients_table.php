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
    Schema::table('patients', function (Blueprint $table) {
        $table->string('status')->default('active'); // or nullable if you prefer
    });
}

public function down()
{
    Schema::table('patients', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
