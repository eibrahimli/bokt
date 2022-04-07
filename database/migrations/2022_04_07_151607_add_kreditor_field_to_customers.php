<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKreditorFieldToCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('kredit_id')->nullable()->comment('Kreditor');
            $table->string('wife_name')->nullable();
            $table->string('wife_surname')->nullable();
            $table->string('wife_fathername')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['kredit_id','wife_name','wife_surname','wife_fathername']);
        });
    }
}
