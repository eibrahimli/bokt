<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetInnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_inner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->comment('Aktivin id-si');
            $table->string('name')->nullable()->comment('Ad');
            $table->string('type')->nullable()->comment('Malların iş və xidmətlərin növü');
            $table->integer('measure')->nullable()->comment('Ölçü vahidi');
            $table->double('unit_price')->nullable()->comment('Qiyməti');
            $table->double('quantity')->nullable()->comment('Miqdar');
            $table->double('price')->nullable()->comment('Məbləği');
            $table->double('edv')->nullable()->comment('ƏDV');
            $table->double('total_price')->nullable()->comment('Tam qiyməti');
            $table->double('debet')->nullable()->comment('Debet');
            $table->double('credit')->nullable()->comment('Kredit');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_id')->on('main_assets')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_inner');
    }
}
