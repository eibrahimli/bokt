<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('termInMonth')->comment('Ay');
            $table->double('totalDept')->comment('Aylıq ödəniləcək məbləğ');
            $table->double('percentDept')->comment('Aylıq ödəniləcək faiz üzrə məbləğ');
            $table->double('mainDept')->comment('Aylıq ödəniləcək əsas üzrə məbləğ');
            $table->double('indebtedness')->comment('Qalıq son məbləğ');
            $table->double('penalty')->default(0)->comment('Gecikməyə görə ödəniş');
            $table->double('percentage_remainder')->default(0)->comment('Faiz üzrə qalıq');
            $table->double('main_remainder')->default(0)->comment('Əsas üzrə qalıq');
            $table->boolean('paid')->default(0)->comment('Aylıq ödəniş statusu');
            $table->dateTime('paid_at')->nullable()->comment('Ödəniş tarixi');

            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id')->on('loans')->references('id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_reports');
    }
}
