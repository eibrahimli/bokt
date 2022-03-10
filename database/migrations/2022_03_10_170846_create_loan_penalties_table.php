<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_penalties', function (Blueprint $table) {
            $table->id();
            $table->double('price')->nullable()->comment('Ümumi cərimə miqdarı');
            $table->double('price_remainder')->nullable()->comment('Ödənilən cərimə miqdarı');
            $table->integer('day')->nullable()->comment('Gecikmə günlərinin sayı');
            $table->boolean('paid')->default(0)->comment('Gecikmə ödənilmişdir');
            $table->unsignedBigInteger('loan_id');
            $table->date('paid_at')->nullable()->comment('Cərimə bu taridə ödənilmişdir');

            $table->foreign('loan_id')->on('loans')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_penalties');
    }
}
