<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToTransactionsAndOtherTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->double('expected_price')->nullable()->comment('Ödəmə olunmalı məbləğ');
        });

        Schema::table('loans', function (Blueprint $table) {
            $table->integer('percentage')->change()->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->foreign('branch_id')->on('branches')->references('id');
            $table->index('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['expected_price']);
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign('branch_id');
            $table->dropIndex('branch_id');
            $table->dropColumn(['branch_id']);
        });
    }
}
