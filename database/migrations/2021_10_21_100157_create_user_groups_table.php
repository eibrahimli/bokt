<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('columns')->nullable();
            $table->integer('priority')
                ->default(1000)
                ->comment('Lesser the value, more import is the group');
            $table->text('menu_items')
                ->nullable();
            $table->char('access_mode', 10)->nullable();
            $table->char('view_mode', 10)->nullable();
            $table->char('edit_mode', 10)->nullable();
            $table->char('delete_mode', 10)->nullable();
            $table->char('create_mode', 10)->nullable();
            $table->char('approve_mode', 10)->nullable();
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
        Schema::dropIfExists('user_groups');
    }
}
