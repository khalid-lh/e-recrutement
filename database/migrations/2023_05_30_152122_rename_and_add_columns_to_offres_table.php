<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAndAddColumnsToOffresTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('pays');
            $table->string('num_rc')->after('register_commerce');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
        });
    }
}
