<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTransactionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->id();
            $table->json('old_report_entries')->nullable()->commment('Kredit transactionsdan qabaq bir öncəki report');
            $table->json('current_report_entries')->nullable()->commment('Kredit transactionsdan hal hazırda report');
            $table->unsignedBigInteger('transaction_id')->nullable();

            $table->foreign('transaction_id')->references('id')->on('transactions');
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
        Schema::dropIfExists('transaction_history');
    }
}
