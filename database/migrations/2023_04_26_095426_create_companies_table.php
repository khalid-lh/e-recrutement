<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('company_id');
            $table->string('company_name')->unique();
            $table->string('telephone');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('description');
            $table->string('photo');
            $table->string('register_commerce');
            $table->string('num_rc');
            $table->string('status');
            $table->integer('id_recruteur');   
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
        Schema::dropIfExists('companies');
    }
}
