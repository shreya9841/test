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
    Schema::table('details', function (Blueprint $table) {
        $table->integer('total_amount')->nullable();
    });
}

public function down()
{
    Schema::table('details', function (Blueprint $table) {
        $table->dropColumn('total_amount');
    });
}

};
