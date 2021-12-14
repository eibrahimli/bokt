<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToTables extends Migration
{

    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->json('credit_report')->comment('Kredit reportu');
            $table->double('credit_balance')->default(0)->comment('Müştəri borcu');
            $table->double('payed_balance')->default(0)->comment('Müştərinin ödədiyi kredit məbləğ miqdarı');
            $table->double('whole_payable_balance')->default(0)->comment('Müştərinin ödəməli olduğu ümumi məbləğ');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->double('percentage')->comment('Məhsul faizi');
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
            $table->dropColumn(['credit_report','credit_balance','payed_balance','whole_payable_balance']);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['percentage']);
        });
    }
}
