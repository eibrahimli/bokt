<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->comment('istifadəçi ümumi rolu');
            $table->string('surname')->after('name')->nullable()->comment('Soyad');
            $table->unsignedBigInteger('user_group_id')->nullable();

            $table->foreign('user_group_id')->on('user_groups')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_group_id']);
            $table->dropColumn(['role','user_group_id','surname']);
        });
    }
}
