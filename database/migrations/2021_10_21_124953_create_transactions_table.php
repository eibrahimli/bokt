<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double('price')->comment('Məbləğ');
            $table->boolean('is_civil')->default(0)->comment('Digər vətandaş tərəfindən ödəniş');
            $table->string('name')->nullable()->comment('Ad');
            $table->string('surname')->nullable()->comment('Soyad');
            $table->string('fathername')->nullable()->comment('Ata Adı');
            $table->string('identity_number')->nullable()->comment('Ş.V. Seriya №');

            $table->double('main_price')->nullable()->comment('Əsas məbləğ üzrə');
            $table->double('interested_price')->nullable()->comment('Marağ faizi üzrə');
            $table->double('calculated_price')->nullable()->comment('Hesablanmış cərimə');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Elave eden');
            $table->unsignedBigInteger('loan_id')->nullable()->comment('Kredit');

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('loan_id')->on('loans')->references('id');
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
        Schema::dropIfExists('transactions');
    }
}
