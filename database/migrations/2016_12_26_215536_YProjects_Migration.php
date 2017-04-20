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
            $table->string('ProjNbr')->nullable();
            $table->string('Description')->nullable();
            $table->string('SolidW')->nullable();
            $table->string('PartNumber')->nullable();
            $table->string('PCBType');
            $table->boolean('stencil')->default(false);
            $table->string('BIOS')->nullable();
            $table->string('Planta')->nullable();
            $table->string('Conn_typ')->nullable();
            $table->string('Group');
            $table->string('Created_By');
            $table->string('engineer')->nullable();
            $table->string('req_qty')->nullable();
            $table->date('due_date')->nullable();
            $table->string('tr_proj')->nullable();
            $table->boolean('cr')->default(false);
            $table->boolean('hv')->default(false);
            $table->boolean('dr')->default(false);
            $table->string('max_volt')->nullable();
            $table->string('max_amp')->nullable();
            $table->string('attachment')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::connection('projects')->create('manufacturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('adress')->nullable();
            $table->string('phone')->nullable();
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('email3')->nullable();
            $table->string('product');
            $table->string('BIOS')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
           
        });

        Schema::connection('projects')->create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('owner')->unsigned()->nullable();
            $table->integer('yproject_id')->unsigned();
            $table->integer('manufacturer_id')->unsigned();
            $table->date('quot_date')->nullable();
            $table->date('offer_date')->nullable();
            $table->date('approv_date')->nullable();
            $table->date('order_date')->nullable();
            $table->integer('qty')->nullable()->unsigned();
            $table->decimal('Initial_cost',6,2)->nullable()->unsigned();
            $table->decimal('cost_piece',5,2)->nullable()->unsigned();
            $table->date('delivery_date')->nullable();
            $table->tinyInteger('status');
            $table->string('offer_pdf')->nullable();
            $table->string('quot_sender')->nullable();
            $table->string('offer_receiver')->nullable();
            $table->string('ordered_by')->nullable();
            $table->string('delivered_to')->nullable();
            $table->string('approv_by')->nullable();
            $table->string('jsonpath')->nullable();
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
        Schema::connection('projects')->drop('orders');

    }
}
