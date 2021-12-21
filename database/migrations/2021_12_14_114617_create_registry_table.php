<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registry', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->nullable()->comment('Mebleg');
            $table->integer('debet')->nullable()->comment('Debet');
            $table->integer('credit')->nullable()->comment('Kredit');
            $table->string('reg_type')->nullable()->comment('Emeliyyat');
            $table->integer('reg_id')->nullable()->comment('Emeliyyat id');
            $table->string('product_id')->nullable()->comment('Xerc tipi');
            $table->string('product_name')->nullable()->comment('Xercin adi');
            $table->unsignedBigInteger('branch_id')->nullable()->comment('Alıcının id-si');
            $table->unsignedBigInteger('account_id')->nullable()->comment('Hesab id-si');
            $table->unsignedBigInteger('customer_id')->nullable()->comment('Müştərinin id-si');
            $table->unsignedBigInteger('contract_id')->nullable()->comment('Müqavilə id-si');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Techizatci id-si');


            $table->softDeletes();
            $table->timestamps();

            $table->index("reg_type");
            $table->index("reg_id");
            $table->index("debet");
            $table->index("credit");

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
        Schema::dropIfExists('registry');
    }
}
