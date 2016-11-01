<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltiumParts extends Migration
{
  
    protected $libraries = ['Ceramic','Tantal','Aluminium','LED','Schottky','TVS','Switch_Diode','Zener','Silicon','Thin_film', 'Thick_film','Wirewound','Multilayer','Bead','Bipolar','MOSFET','Y_Connectors','Connectors','Relays','Switch','Sensor', 'Amplifier','Interface','Logic','MCU','Memory','Power','Crystal','Misc']; 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->libraries as $key => $libTable) {
            Schema::connection('Altium')->create($libTable, function (Blueprint $table) {

                $table->increments('id');
                $table->string('Y_PartNr');
                $table->string('Library Ref');
                $table->string('Footprint Ref');
                $table->text('Description');
                $table->string('Manufacturer');
                $table->string('Manufacturer Part Number');
                $table->string('Supplier 1');
                $table->string('Supplier Part Number 1');
                $table->string('Supplier 2')->nullable();
                $table->string('Supplier Part Number 2')->nullable();
                $table->string('Supplier 3')->nullable();
                $table->string('Supplier Part Number 3')->nullable();
                $table->string('revision')->nullable();
                $table->timestamp('Last_modified')->nullable();
                $table->string('modified_by')->nullable();
                $table->timestamps();

                $table->engine = 'InnoDB';
                $table->unique('Y_PartNr');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->libraries as $key => $libTable){
            Schema::connection('Altium')->drop($libTable);
        }

    }
}
