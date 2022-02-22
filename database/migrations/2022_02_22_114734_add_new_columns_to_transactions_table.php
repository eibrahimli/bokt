<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->date('shouldPay')->nullable()->comment('Müştərinin o ay üçün ödəməli olduğu tarix');
            $table->boolean('service_fee')->default(0)->comment('Service haqqı ödənildimi');
            $table->string('description')->nullable()->default('Kredit ödənişi')->comment('Xidmət haqqı ödənişi');
        });

        Schema::table('loans', function (Blueprint $table){
            $table->boolean('serviceFeePayed')->default(0)->comment('Kredit üzrə xidmət haqqı ödənilibmi?');
        });

        DB::statement('alter table transactions modify price double NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['shouldPay','service_fee','description']);
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['serviceFeePayed']);
        });
    }
}
