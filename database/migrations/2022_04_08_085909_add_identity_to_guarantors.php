<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdentityToGuarantors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guarantors', function (Blueprint $table) {
            $table->string('identity_agency')->after('identity_number')->nullable()->comment('Şəxsiyyəti verən orqan');
            $table->date('identity_given_date')->after('identity_number')->nullable()->comment('Şəxsiyyət verilən vaxtı');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guarantors', function (Blueprint $table) {
            //
        });
    }
}
