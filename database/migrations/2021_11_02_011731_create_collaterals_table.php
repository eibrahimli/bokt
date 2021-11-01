<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollateralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaterals', function (Blueprint $table) {
            $table->id();
            $table->string('collateral_name')->comment('Girov adi');
            $table->unsignedBigInteger('trick_id')->comment('Əyyar');
            $table->unsignedBigInteger('loan_id')->comment('Kredit');
            $table->double('gram')->comment('Girov qram');
            $table->double('collateral_price')->comment('Girov Dəyər');
            $table->string('files')->nullable();
            $table->foreign('trick_id')->on('tricks')->references('id');
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
        Schema::dropIfExists('collaterals');
    }
}
