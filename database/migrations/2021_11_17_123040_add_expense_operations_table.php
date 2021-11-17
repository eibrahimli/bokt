<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpenseOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('expense_operations', function (Blueprint $table) {
            $table->double('edv_percent')->nullable()->comment('ƏDV dərəcəsi');
            $table->double('edv_price')->nullable()->comment('ƏDV məbləği');
            $table->unsignedBigInteger('asset_category_id')->nullable();
            $table->foreign('asset_category_id')->on('asset_categories')->references('id');
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

        Schema::table('expense_operations', function (Blueprint $table) {
            $table->removeColumn('edv_percent');
            $table->removeColumn('edv_price');
            $table->removeColumn('asset_category_id');
            $table->dropForeign('asset_category_id');
        });
    }
}
