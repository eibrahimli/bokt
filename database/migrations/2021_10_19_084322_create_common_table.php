<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    protected $tables = ['tricks', 'consumptions', 'productions','agricultures','trades','services','transportations','products'];

    public function up()
    {
       foreach ($this->tables as $table):
           Schema::create($table, function (Blueprint $table) {
               $table->id();
               $table->string('name')->comment('Ad');
               $table->softDeletes();
               $table->timestamps();
           });
       endforeach;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table):
            Schema::dropIfExists($table);
        endforeach;
    }
}
