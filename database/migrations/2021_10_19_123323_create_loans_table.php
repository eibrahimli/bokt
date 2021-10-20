<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('percentage')->comment('Faiz');
            $table->integer('month')->comment('Ay (Müddət)');
            $table->unsignedBigInteger('user_id')->comment('User (Credit officer');
            $table->unsignedBigInteger('customer_id')->comment('Müştəri');
            $table->double('price')->comment('Məbləğ');
            $table->string('collateral_name')->comment('Girov adi');
            $table->unsignedBigInteger('trick_id')->comment('Əyyar');
            $table->unsignedBigInteger('service_id')->comment('Xidmetler');
            $table->unsignedBigInteger('consumption_id')->comment('Istehlak');
            $table->unsignedBigInteger('agriculture_id')->comment('Kənd Təsərüffatı');
            $table->unsignedBigInteger('production_id')->comment('İstehsal');
            $table->unsignedBigInteger('trade_id')->comment('Ticaret');
            $table->unsignedBigInteger('transportation_id')->comment('Nəqliyyat');
            $table->double('gram')->comment('Girov qram');
            $table->double('collateral_price')->comment('Girov Dəyər');
            $table->boolean('approved')->default(0)->comment('Təsdiq');
            $table->boolean('status')->comment('Supervisor tesdiq etdi');

            $table->foreign('trick_id')->on('tricks')->references('id');
            $table->foreign('service_id')->on('services')->references('id');
            $table->foreign('consumption_id')->on('consumptions')->references('id');
            $table->foreign('agriculture_id')->on('agricultures')->references('id');
            $table->foreign('production_id')->on('productions')->references('id');
            $table->foreign('transportation_id')->on('transportations')->references('id');
            $table->foreign('trade_id')->on('trades')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
            $table->foreign('customer_id')->on('customers')->references('id');

            $table->softDeletes();
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
        Schema::dropIfExists('loans');
    }
}
