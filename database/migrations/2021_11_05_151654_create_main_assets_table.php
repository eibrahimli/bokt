<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable()->comment('Alıcının id-si');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Təchizatçının id-si');
            $table->unsignedBigInteger('contract_id')->nullable()->comment('Müqavilə id-si');
            $table->string('invoice_number')->nullable()->comment('Hesab faktura nömrəsi');
            $table->string('einvoice_number')->nullable()->comment('EQF nömrəsi');
            $table->dateTime('einvoice_date')->nullable()->comment('EQF Tarixi');
            $table->unsignedBigInteger('dep_account_id')->nullable()->comment('Amortizasiya hesabı');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Məsul şəxs');
            $table->string('asset_location')->nullable()->comment('Əsas vəsaitin yerləşdiyi yer');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('branch_id')->on('branches')->references('id');
            $table->foreign('supplier_id')->on('suppliers')->references('id');
            $table->foreign('contract_id')->on('contracts')->references('id');
            $table->foreign('dep_account_id')->on('depreciation_accounts')->references('id');
            $table->foreign('user_id')->on('users')->references('id');


            $table->index("branch_id");
            $table->index("supplier_id");
            $table->index("dep_account_id");
            $table->index("contract_id");
            $table->index("user_id");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_assets');
    }
}
