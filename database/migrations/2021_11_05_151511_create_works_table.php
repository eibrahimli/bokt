<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function    (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->comment('Alıcının id-si');
            $table->unsignedBigInteger('supplier_id')->comment('Təchizatçının id-si');
            $table->unsignedBigInteger('contract_id')->comment('Müqavilə id-si');

            $table->string('invoice_number')->nullable()->comment('Hesab faktura nömrəsi');
            $table->json('total_result')->nullable()->comment('Umumi qiymət , ədv nəticəsi');
            $table->tinyInteger('status')->comment('Status');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('branch_id')->on('branches')->references('id');
            $table->foreign('supplier_id')->on('suppliers')->references('id');
            $table->foreign('contract_id')->on('contracts')->references('id');

            $table->index(["branch_id"]);
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
        Schema::dropIfExists('works');
    }
}
