<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Təçhizatçının adı');
            $table->string('voen')->comment('VÖEN');
            $table->enum('status',['0', '1'])->default('1')->comment('Status');
            $table->timestamps();

            $table->unsignedBigInteger('country_id')->comment('Qeydiyyatda olduğu ölkə');
            $table->foreign('country_id')->on('countries')->references('id');

            $table->unsignedBigInteger('customer_type')->comment('Təçhizatçının növü');
            $table->foreign('customer_type')->on('customer_types')->references('id');

            $table->index(["country_id","customer_type","status","voen"]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
