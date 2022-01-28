<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('status')->default(1);
            $table->integer('min_price')->nullable();
            $table->integer('max_price')->nullable();
            $table->integer('min_date')->nullable();
            $table->integer('max_date')->nullable();
            $table->double('service_fee')->nullable();
            $table->double('delay_percentage')->nullable()->comment('Gecikmə faizi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['status','min_price','max_price','service_fee','delay_percentage','min_date', 'max_date']);
        });
    }
}
