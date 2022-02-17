<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('works', function (Blueprint $table) {
            $table->string('contract_number')->nullable()->comment('Müqavilə nömrəsi');
            $table->date('contract_date')->nullable()->comment('Müqavilə müddəti');
            $table->timestamp('contract_begin')->nullable();
            $table->timestamp('contract_end')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn(['contract_number']);
            $table->dropColumn(['contract_date']);
            $table->dropColumn(['contract_begin']);
            $table->dropColumn(['contract_end']);
        });
    }
}
