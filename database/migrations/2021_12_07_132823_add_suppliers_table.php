<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('suppliers', function (Blueprint $table) {
            $table->double('paid_amount')->nullable()->comment('Ödənilən məbləğ');
            $table->double('rest_amount')->nullable()->comment('Qalıq məbləğ');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn(['paid_amount', 'rest_amount']);
        });
    }
}
