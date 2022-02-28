<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenaltyDayToLoanReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_reports', function (Blueprint $table) {
            $table->integer('penalty_day')->default(0)->comment('Müştərinin kreditinin ay görə gecikməsi');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->integer('penalty_day')->default(0)->comment('Müştərinin gecikmə günlərinin sayı');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('penalty_day')->default(0)->comment('Müştərinin gecikmə günlərinin sayı');
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
            $table->dropColumn(['penalty_day']);
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['penalty_day']);
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['penalty_day']);
        });
    }
}
