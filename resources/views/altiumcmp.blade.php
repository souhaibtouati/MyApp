@extends('layouts.master')

@section('content')
<h1 style="margin-top: 0px"><i class="fa fa-cubes"></i> Library Categories</h1>
<hr>
<!-- Passive Components -->

<div class="row">
<div class="col-lg-2">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
             <!--  <span class="info-box-text">Bookmarks</span> -->
              <span class="info-box-number">Passive</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Resistors</h3>

              <p>Thin film / Thick film</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="/Altium/Resistor" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
  
<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Inductors</h3>

              <p>Wirewound / Multilayer / Bead</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="/Altium/Inductor" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Capacitors</h3>

              <p>Aluminium / Tantal / Ceramic</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="/Altium/Capacitor" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

</div>

<!-- Integrated Circuits -->

<div class="row">
<div class="col-lg-2">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
             <!--  <span class="info-box-text">Bookmarks</span> -->
              <span class="info-box-number">Integrated Circuits</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>PWR</h3>

              <p>Power Management</p>
            </div>
            <div class="icon">
              <i class="fa fa-flash"></i>
            </div>
            <a href="/Altium/PWR" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
  
<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Control</h3>

              <p>MCU / Memory / Logic</p>
            </div>
            <div class="icon">
              <i class="fa fa-server"></i>
            </div>
            <a href="/Altium/Control" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Signal</h3>

              <p>Amplifiers / Interfaces</p>
            </div>
            <div class="icon">
              <i class="fa fa-random"></i>
            </div>
            <a href="/Altium/Signal" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

</div>


<!-- SemiConductors -->

<div class="row">
<div class="col-lg-2">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
             <!--  <span class="info-box-text">Bookmarks</span> -->
              <span class="info-box-number">Semiconductors</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Diodes</h3>

              <p>LED / Schottky / Zener ...</p>
            </div>
            <div class="icon">
              <i class="fa fa-caret-right"></i>
            </div>
            <a href="/Altium/Diode" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Transistors</h3>

              <p>Bipolar / MOSFET</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="/Altium/Transistor" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

</div>



<!-- Electromechanical -->

<div class="row">
<div class="col-lg-2">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
             <!--  <span class="info-box-text">Bookmarks</span> -->
              <span class="info-box-number">Electromechanical</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Connectors</h3>

              <p>Yamaichi / General</p>
            </div>
            <div class="icon">
              <i class="fa fa-plug"></i>
            </div>
            <a href="/Altium/Connector" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Command</h3>

              <p>Relays / Switches</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="/Altium/Command" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
<div class=" col-lg-3">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Others</h3>

              <p>Sensors / Cristals / Misc</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="/Altium/Others" class="small-box-footer">
              Enter  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>      

</div>
@endsection

