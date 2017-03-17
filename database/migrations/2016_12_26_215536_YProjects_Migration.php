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
        Schema::connection('projects')->create('yprojects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ProjNbr');
            $table->string('Description')->nullable();
            $table->string('SolidW')->nullable();
            $table->string('PartNumber')->nullable();
            $table->string('PCBType');
            $table->string('BIOS')->nullable();
            $table->string('Planta')->nullable();
            $table->integer('Stencil_Manuf')->nullable()->unsigned();
            $table->string('Conn_typ');
            $table->integer('PCB_Manuf')->nullable()->unsigned();
            $table->string('Group');
            $table->string('Created_By');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::connection('projects')->create('manufacturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('adress')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('product');
            $table->string('BIOS')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
           
        });

        Schema::connection('projects')->create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('project_id');
            $table->integer('manufacturer_id');
            $table->date('quot_date')->nullable();
            $table->date('offer_date')->nullable();
            $table->date('approv_date')->nullable();
            $table->date('order_date')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('Initial_cost',3,2)->nullable();
            $table->decimal('cost_piece',3,2)->nullable();
            $table->date('delivery_date')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->engine = 'InnoDB';
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('projects')->drop('yprojects');
        Schema::connection('projects')->drop('manufacturers');
    }
}
