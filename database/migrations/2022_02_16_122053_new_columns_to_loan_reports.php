<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColumnsToLoanReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_reports', function (Blueprint $table) {
            $table->boolean('not_paid_percentage_interest')->default(false)->comment('Krediti öncədən bağlayıbsa true');
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->boolean('closed')->default(false)->comment('Kredit ödəndi');
            $table->dateTime('approved_date')->nullable()->comment('Kreditin təsdiq olunduğu vaxt');
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
            $table->dropColumn(['not_paid_percentage_interest']);
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['closed','approved_date']);
        });
    }
}
