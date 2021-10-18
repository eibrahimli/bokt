<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('Ad');
            $table->string('surname')->nullable()->comment('Soyad');
            $table->string('fathername')->nullable()->comment('Ata Adı');
            $table->string('fin')->nullable()->comment('Fin');
            $table->string('identity_number')->nullable()->comment('Ş.V. Seriya №');
            $table->text('registration_address')->nullable()->comment('Qeydiyyat ünvanı');
            $table->text('residential_address')->nullable()->comment('Yaşayış ünvanı');
            $table->enum('gender', ['male', 'female'])->nullable()->comment('Cins');;
            $table->string('contact_phone')->nullable()->comment('Contact number');
            $table->string('contact_phone_1')->nullable()->comment('Contact number #1');
            $table->string('contact_phone_2')->nullable()->comment('Contact number #2');
            $table->string('contact_phone_3')->nullable()->comment('Contact number #3');
            $table->boolean('is_immigrant')->default(0)->comment('Məcburi Köçkün');
            $table->enum('maritial_status',['married', 'single'])->default('single')->comment('Ailə Vəziyyəti');
            $table->text('attachments')->nullable()->comment('Attachments');
            $table->date('date_of_birth')->nullable()->comment('Doğum tarixi');
            $table->string('birthplace')->nullable()->comment('Doğum yeri');
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
        Schema::dropIfExists('customers');
    }
}
