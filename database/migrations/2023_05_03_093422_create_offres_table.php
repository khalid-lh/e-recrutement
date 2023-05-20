<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    
    public function up()
    {
        Schema::create('offres', function(Blueprint $table){
            $table->id('id_offre');
            $table->integer('id_recruteur');
            $table->string('titre_offre');
            $table->longText('description');
            $table->integer('n_postes');
            $table->string('status');
            $table->string('type_offre');
            $table->string('duree')->nullable();
            $table->string('convention')->nullable();
            $table->string('annee_experience')->nullable();
            $table->string('company_id');
            $table->string('presence');
            $table->string('slug');     
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
        Schema::dropIfExists('offres');
    }
}
