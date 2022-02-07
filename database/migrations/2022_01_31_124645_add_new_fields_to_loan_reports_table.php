<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToLoanReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_reports', function (Blueprint $table) {
            $table->date('shouldPay')->comment('Odəməli olduğu tarix');
        });

        Schema::table('loan_reports', function (Blueprint $table) {
            $table->string('termInMonth')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_reports', function (Blueprint $table) {
            $table->dropColumn('shouldPay');
        });
    }
}
