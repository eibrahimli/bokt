<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewFieldsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->double('whole_percentage_price')->comment('Umumi ödəniləcək faiz məbləği')->nullable();
            $table->double('current_main_price')->comment('Hal hazırkı qalıq əsas məbləğ')->nullable();
            $table->double('current_percentage_price')->comment('Hal hazırkı qalıq faiz məbləği')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            //
        });
    }
}
