<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('indentity_agency')->nullable()->comment('Şəxsiyyəti verən orqan');
            $table->date('intentity_given_date')->nullable()->comment('Şəxsiyyət verilən vaxtı');
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
            $table->dropColumn(['indentity_agency', 'intentity_given_date']);
        });
    }
}
