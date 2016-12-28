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
            $table->string('Description')->nullable();
            $table->string('SolidW');
            $table->string('PartNumber')->nullable();
            $table->string('ProductType');
            $table->string('GenesisW')->nullable();
            $table->string('Planta')->nullable();
            $table->string('Application')->nullable();
            $table->string('Customer')->nullable();
            $table->string('Responsible')->nullable();
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
