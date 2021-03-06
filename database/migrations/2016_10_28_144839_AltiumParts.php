<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltiumParts extends Migration
{
    
    protected $Models = ['Capacitor', 'Command', 'Connector', 'Control', 'Diode', 'Inductor', 'Others', 'PWR', 'Resistor', 'Signal', 'Transistor'];
    
    protected $Part;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->Models as $key => $Model) {
            $class = '\App\Altium\Models\\'.$Model;
            $this->Part = new $class();
            foreach ($this->Part->getTables() as $key => $Table) {

                Schema::connection('Altium')->create($Table, function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('Y_PartNr');
                    $table->string('Library Ref');
                    $table->string('SYMPath')->nullable();
                    $table->string('Footprint Ref');
                    $table->string('FTPTPath')->nullable();
                    $table->string('Description');
                    $table->string('ComponentLink1Description')->default('Datasheet');
                    $table->string('ComponentLink1URL')->nullable();
                    $table->string('Manufacturer');
                    $table->string('Manufacturer Part Number');
                    $table->string('Supplier 1');
                    $table->string('Supplier Part Number 1');
                    $table->string('Supplier 2')->nullable();
                    $table->string('Supplier Part Number 2')->nullable();
                    $table->string('Supplier 3')->nullable();
                    $table->string('Supplier Part Number 3')->nullable();
                    $table->integer('Revision')->nullable();
                    $table->string('Package')->nullable();
                    $table->string('modified_by')->nullable();
                    foreach ($this->Part->getChildFill() as $key => $child) {
                        $table->string($child)->nullable();
                    }

                    $table->timestamps();
                    $table->engine = 'InnoDB';
                    $table->unique('Y_PartNr');
                });

            }
            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->Models as $key => $Model) {
            $class = '\App\Altium\Models\\'.$Model;
            $this->Part = new $class();
            foreach ($this->Part->getTables() as $key => $Table) {
                Schema::connection('Altium')->drop($Table);
            }

        }
    }
}
