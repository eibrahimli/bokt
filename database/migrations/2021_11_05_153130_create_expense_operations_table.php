<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable()->comment('Alıcının id-si');
            $table->unsignedBigInteger('account_id')->nullable()->comment('Hesab id-si');
            $table->unsignedBigInteger('customer_id')->nullable()->comment('Müştərinin id-si');
            $table->unsignedBigInteger('contract_id')->nullable()->comment('Müqavilə id-si');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Techizatci id-si');
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
            $table->foreign('customer_id')->on('customers')->references('id');
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
        Schema::dropIfExists('expense_operations');
    }
}
