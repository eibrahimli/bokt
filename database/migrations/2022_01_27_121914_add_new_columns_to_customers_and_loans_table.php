<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToCustomersAndLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_unit_id')->nullable()->comment('Iqtisadi rayon');
            $table->unsignedBigInteger('legal_status_id')->nullable()->comment('Hüquqi fiziki');
            $table->unsignedBigInteger('branch_id')->nullable()->comment('Müştərinin aid olduğu filial');

            $table->unsignedBigInteger('voen')->nullable();

            $table->foreign('admin_unit_id')->on('admin_units')->references('id');
            $table->foreign('legal_status_id')->on('legal_statuses')->references('id');
            $table->foreign('branch_id')->on('branches')->references('id');
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
            $table->dropForeign('admin_unit_id');
            $table->dropForeign('legal_status_id');
            $table->dropForeign('branch_id');

            $table->dropColumn(['branch_id', 'admin_unit_id', 'legal_status_id','voen']);
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign('branch_id');

            $table->dropColumn(['branch_id']);
        });

    }
}
