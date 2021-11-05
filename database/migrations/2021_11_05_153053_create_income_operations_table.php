<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable()->comment('Alıcının id-si');
            $table->unsignedBigInteger('account_id')->nullable()->comment('Hesab id-si');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Təçhizatçının id-si');
            $table->unsignedBigInteger('contract_id')->nullable()->comment('Müqavilə id-si');
            $table->double('edv_percent')->nullable()->comment('ƏDV dərəcəsi');
            $table->double('edv_price')->nullable()->comment('ƏDV meblegi');
            $table->double('price')->nullable()->comment('Odenisin meblegi');
            $table->string('purpose_payment')->nullable()->comment('Ödənişin təyinatı');
            $table->double('debet')->nullable()->comment('Debet');
            $table->double('credit')->nullable()->comment('Kredit');
            $table->unsignedBigInteger('operation_method')->nullable()->comment('Əməliyyat növü');
            $table->timestamp('payment_date')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('branch_id')->on('branches')->references('id');
            $table->foreign('account_id')->on('accounts')->references('id');
            $table->foreign('supplier_id')->on('suppliers')->references('id');
            $table->foreign('contract_id')->on('contracts')->references('id');

            $table->index("branch_id");
            $table->index("account_id");
            $table->index("supplier_id");
            $table->index("contract_id");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_operations');
    }
}
