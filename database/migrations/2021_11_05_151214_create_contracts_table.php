<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->comment('Alıcının id-si');
            $table->unsignedBigInteger('supplier_id')->comment('Təçhizatçının id-si');
            $table->string('contract_number')->nullable()->comment('Müqavilə nömrəsi');
            $table->double('price')->nullable()->comment('Müqavilə məbləği');
            $table->double('advance_price')->nullable()->comment('Avans məbləği');
            $table->string('currency_type')->nullable()->comment('Valyuta');
            $table->date('contract_date')->nullable()->comment('Müqavilə müddəti');
            $table->timestamp('contract_begin')->nullable();
            $table->timestamp('contract_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supplier_id')->on('suppliers')->references('id');
            $table->foreign('branch_id')->on('branches')->references('id');

            $table->index(["branch_id"]);
            $table->index("supplier_id");
            $table->index("currency_type");
            $table->index("contract_date");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
