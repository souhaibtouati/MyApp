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
                    $table->string('Library_Ref');
                    $table->string('SYMPath');
                    $table->string('FTPTPath');
                    $table->string('Footprint_Ref');
                    $table->text('Description');
                    $table->string('ComponentLink1URL')->nullable();
                    $table->string('ComponentLink2URL')->nullable();
                    $table->string('Manufacturer');
                    $table->string('Manufacturer_Part_Number');
                    $table->string('Supplier_1');
                    $table->string('Supplier_Part_Number_1');
                    $table->string('Supplier_2')->nullable();
                    $table->string('Supplier_Part_Number_2')->nullable();
                    $table->string('Supplier_3')->nullable();
                    $table->string('Supplier_Part_Number_3')->nullable();
                    $table->string('Revision')->nullable();
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
