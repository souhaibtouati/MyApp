<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class YProjectsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yprojects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ProjNumber');
            $table->string('Description');
            $table->string('SWNumber');
            $table->string('PartNumber');
            $table->string('ProductGroup');
            $table->string('GW_Planta');
            $table->string('Application');
            $table->string('Customer');
            $table->string('Responsible');
            $table->string('Group');
            $table->string('Created_By');
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
        Schema::drop('yprojects');
    }
}
