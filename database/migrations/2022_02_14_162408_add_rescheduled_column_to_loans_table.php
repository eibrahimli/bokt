<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRescheduledColumnToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->boolean('rescheduled')->default(0)->comment('Yenidən cədvəl yarıdıldımı');
            $table->double('rescheduled_price')->nullable()->comment('Yenidən cədvəlin yarandığındakı əsas məbləğ');
            $table->json('rescheduled_report')->nullable()->comment('Yeni cədvəl');
            $table->double('rescheduled_payed_balance')->nullable()->comment('Yeni cədvəl ödənilən məbləğ');
            $table->double('rescheduled_whole_payable_balance')->nullable()->comment('Yeni cədvəl ödəniləcək məbləğ');
            $table->double('rescheduled_month')->nullable()->comment('Yeni cədvəl ay');
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
            $table->dropColumn(['rescheduled','rescheduled_price','rescheduled_report','rescheduled_payed_balance','rescheduled_whole_payable_balance']);
        });
    }
}
