@extends('layouts.master')

@section ('head')
<style type="text/css">
	.content-wrapper {background-color: white; font-size: 20px}
</style>
@endsection

@section('content-header')
<h1><b>Altium </b>Documentation</h1>
@endsection

@section('content')

<h3># Summary</h3>
<p>
	<h4><a href="#initsetup"><i class="fa fa-circle-o"></i> Initial Setup</a></h4>
	<h4><a href="#partmodel"><i class="fa fa-circle-o"></i> Part Model</a></h4>
	<h4><a href="#cat"><i class="fa fa-circle-o"></i> Categories</a></h4>
	<h4><a href="#partcre"><i class="fa fa-circle-o"></i> Part Creation</a></h4>
	<h4><a href="#partview"><i class="fa fa-circle-o"></i> Browse Parts</a></h4>
	<h4><a href="#livese"><i class="fa fa-circle-o"></i> Live Search</a></h4>

</p>

<h2># Introduction</h2>
<p>
	Through this section, we will describe in details the workflow of the Altium™ components lifecycle management.
	Throughout this document, we will see how we can create, update, view and manage our components database from within this application.
</p>

<h2 id="initsetup"># Initial Setup</h2>
<p>
	Before starting to use this application,<br>
	1. Please take few seconds to check all your account information in <a href="{{url('/myprofile')}}">My Profile</a>.<br>
	2. If you want to create components or check parts status, you have to update your <a href="{{url('/Settings/Altium/SVN')}}">SVN credentials</a> in the Settings.<br>
	3. To connect Altium with this application, you have to download and install these <a href="#"><i class="fa fa-download"></i> SVNDBLIB</a> files in altium designer.<br><br>

	For more information about SVN Database Library, you can visit: <a href="http://techdocs.altium.com/display/ADOH/Working+with+Version-Controlled+Database+Libraries">Altium Documentation</a>
</p>

<h2 id="partmodel"># Part Model</h2>
<p>
	The altium Part, is an abstract object that will be devided in <strong>Categories</strong> (Resistors, Power IC, Diode..), each component will inherit his attributes from the abstract part.<br>
	The abstract part, is composed of all the attributes shared by all altium components (name, Library Ref, Footprint Ref..).<br>
	Each category will have the abstract part's attributes and some additional attributes that depend on each model.
</p><br>
<div style="margin-left: 20%">
	<img src="{{asset('/img/model-diagram.png')}}" style="width: 800px">
</div>
<br>
<h2 id="cat"># Categories</h2><br>
<div class="row">
	<div class="col-md-3">
		<span style="color: blue">-- Passives</span><br>
		<span style="color: green">------ <strong>Resistors</strong><br></span>
		----------Thin Film<br>
		----------Thick Film<br>
		<span style="color: green">------ <strong>Inductors</strong><br></span>
		----------Wirewound<br>
		----------Multilayer<br>
		----------Bead<br>
		<span style="color: green">------ <strong>Capacitors</strong><br></span>
		----------Aluminium<br>
		----------Tantal<br>
		----------Ceramic<br>
	</div>
	
	<div class="col-md-3">
		<span style="color: blue">-- Integrated Circuits</span><br>
		<span style="color: green">------ <strong>Power</strong><br></span>
		----------Power Management<br>
		<span style="color: green">------ <strong>Control</strong><br></span>
		----------MCU<br>
		----------Memory<br>
		----------Logic<br>
		<span style="color: green">------ <strong>Signal</strong><br></span>
		----------Amplifiers<br>
		----------Interfaces<br>
	</div>
	
	<div class="col-md-3">
		<span style="color: blue">-- Semiconductors</span><br>
		<span style="color: green">------ <strong>Diodes</strong><br></span>
		----------LED<br>
		----------Schottky<br>
		----------Zener<br>
		----------TVS<br>
		----------Switch<br>
		----------Silicon<br>
		<span style="color: green">------ <strong>Transistors</strong><br></span>
		----------Bipolar<br>
		----------MOSFET<br>
	</div>
	<div class="col-md-3">
		<span style="color: blue">-- Electromechanical</span><br>
		<span style="color: green">------ <strong>Connectors</strong><br></span>
		----------Yamaichi<br>
		----------General<br>
		<span style="color: green">------ <strong>Command</strong><br></span>
		----------Relays<br>
		----------Switches<br>
		<span style="color: green">------ <strong>Others</strong><br></span>
		----------Sensors<br>
		----------Cristals<br>
		----------Misc<br>
	</div>
</div>
<br>
<h3>Category View</h3>
<img src="{{asset('/img/doc/topline.jpg')}} ">
<br><br>
<p>
	When you enter one of the available category, you will have a view like in the example above.<br>
	1. First you have to choose the component type on the top left.<br>
	2. Then you have to choose wich action to do in this component Library:<br>
	<i class="fa fa-list"></i> <strong>Lib View:</strong> To see a list of all components in that library.<br>
	<i class="fa fa-plus"></i> <strong>New [Part]:</strong> To Create a new part in the database.<br>
	<i class="fa fa-search"></i> <strong>Search:</strong> To Find a specific part by description or MPN...<br>
</p>
<br>

<h2 id="partcre"># Part Creation</h2>
<p>
	In order to incorporate a vault-like, Altium SVN database Library, the part creation workflow has to be like follows
</p>
<p>
	1. Create a new Schematic library and draw the component <strong>symbol</strong> inside it. <small>be sure to give the same name to the Schlib file and the symbol inside it</small>. <br>
</p>
<div class="col-md-2">
	<img src="{{asset('/img/doc/SYM.jpg')}}">
</div>
<div class="col-md-10" style="margin-bottom: 20px">
	<img src="{{asset('/img/doc/schlib.jpg')}}">
</div>

<p>
	2. Create a new PCB Library and draw the component <strong>Footprint</strong> inside it. <small>be sure to give the same name to the PCBlib file and the footprint inside it</small>.<br>
</p>
<div class="col-md-2">
	<img src="{{asset('/img/doc/FTPT.jpg')}}">
</div>
<div class="col-md-10" style="margin-bottom: 20px">
	<img src="{{asset('/img/doc/pcblib.jpg')}}">
</div>

<p>
	3. Go to <i class="fa fa-cubes"></i> Altium Library > <i class="fa fa-cube"></i> Category X. <br>
	4. Choose part type as shown in section "Category View". And Click on <i class="fa fa-plus"></i> Create [Part].<br>
	5. Choose the created <strong>SchLib</strong> file to upload to SVN, or select an existing Symbol.<br>
	6. Choose the created <strong>PCBLib</strong> file to upload to SVN, or select an existing Footprint.<br>
	7. Choose the <strong>Datasheet</strong> file to upload to server, or select an existing datasheet.<br>
</p>
<img src="{{asset('/img/doc/uploads.jpg')}}" style="margin-left: 20%">

<p>
	8. Fill-in the component attributes "Description, suppliers, parameters..."<br>
	9. Save and wait few seconds for files to be imported to svn.<br>
</p>

<div class="callout callout-info">
	<h4><i class="fa fa-info"></i> Tip</h4>
	<i class="fa fa-circle-o"></i> You can use the live octopart data search on the right hand side of the screen that will be described below, to automatically fill the manufacturer and supplier details.<br>
	<i class="fa fa-circle-o"></i> After you put the Manufacturer part number, you can click on <button class="btn btn-flat" style="color: black">Specs &nbsp;<i class="fa fa-arrow-circle-right"></i></button> to automatically get part specs that you can use to fill in the parameters.
</div>


<h2 id="partview"># Browse Parts</h2>
<p>
	To browse all the parts in a specific database you can go to:<br>
	1. <i class="fa fa-cubes"></i> Altium Library > <i class="fa fa-cube"></i> Category X <br>
	2. Choose part type as shown in section "Category View". And Click on <i class="fa fa-list"></i> Lib View<br>
	3. Click on <i class="fa fa-refresh"></i> Refresh to dispaly a table of all components.<br>
</p>
<p>
	After the table is displayed correctly you can browse through or search to get the wanted component.
</p>
<img src="{{asset('/img/doc/libview.jpg')}}" style="margin-bottom: 20px">
<p>
	<i class="fa fa-circle-o"></i> Click on <button class="btn btn-info"><i class="fa fa-eye"></i></button> to <strong>View</strong> a particular part. <br>
	<i class="fa fa-circle-o"></i> Click on <button class="btn btn-primary"><i class="fa fa-edit"></i></button> to <strong>Update</strong> a particular part. <br>
	<i class="fa fa-circle-o"></i> Click on <button class="btn btn-danger"><i class="fa fa-trash"></i></button> to <strong>Delete</strong> a particular part. Only administrators can delete parts <br>
</p>
<h3><strong><i class="fa fa-eye"></i> Part View</strong></h3>
<p>
	In the <strong>Altium Links</strong> section, you can find the part details related to it's identity in Altium Designer Library. You can click on <span><a><i class="fa fa-external-link"></i></a></span> to view the related Datasheet.
</p>
<img src="{{asset('/img/doc/altium_links.jpg')}}" style="margin-bottom: 20px">

<p>
	In the <strong>Parameters</strong> section, you can find the particular parameters related to the specific category that the part belongs to.
</p>
<img src="{{asset('/img/doc/params.jpg')}}" style="margin-bottom: 20px">

<p>
	In the <strong>Database History</strong> section, you can find a listing of the product lifecycle, in particular, the revision, the creation data of the part, the last person that made changes to the part parameters and the data it was updated. Note: each time you update the part information, the revision number will be incremented automatically.
</p>
<img src="{{asset('/img/doc/params.jpg')}}" style="margin-bottom: 20px">

<p>
	In order to get the part's SVN history, you have to click on <button class="btn btn-primary"><i class="fa fa-globe"></i>&nbsp; SVN Info</button> on the top right corner. and it will show the following dialog.
</p>
<img src="{{asset('/img/doc/svninfo.jpg')}}" style="margin-top: 20px">
<p>
	For each commit to svn you can get the revision number, the person who made that commit, the date, and the message he left for his modification. Even the changes commited from within Altium Designer will be reflected here.
</p>

<h2 id="livese"># Live Search</h2>
<div class="row">
	<div class="col-md-6"><img src="{{asset('/img/doc/octo1.jpg')}}" style="margin-top: 20px"></div>
	<div class="col-md-6"><img src="{{asset('/img/doc/octo2.jpg')}}" style="margin-top: 20px"></div>
</div>

<p>
	The live search feature, is a powerful option to minimize the searching time for product availability.
	You can type a <strong>Keyword</strong> in the input field and you will get a list of available parts with different Manufacturer Part Number. <br>
	Once you find the suitable MPN, you can click on that particular line and browse through a list of all available suppliers with theier corresponding Part number and Stock.<br>
	By clicking on the <button class="btn btn-primary"><i class="fa fa-plus"></i></button> button, you can add that supplier to the part's supplier list.<br>
	As per Altium designer, you can only add up to 3 supplier links.
</p>

<div class="callout callout-info">
	<h4><i class="fa fa-info"></i> Tip</h4>
	<i class="fa fa-circle-o"></i> By using the live search feature, we can ease up the use of <strong>Altium Live BOM</strong> document. Altium will automatically assign the added supplier links to create an interactive BOM and will be capable of fetching the parts availability and stock data in real time.
</div>

<p>
	The Altium Active BOM Document is a very powerful tool for <strong>BOM Generation & Validation</strong><br>
	From the supplier links that we add in our application to each part. Altium will automatically get the part supply chain data, and give us the ability to switch between suppliers if there is no enough stock or the price is too high. As well as giving accurate price estimation for our PCB.<br>
	For more information about Altium Active BOM, you can visit: <a href="http://www.altium.com/documentation/17.0/display/ADES/((ActiveBOM))_AD">http://www.altium.com/documentation/17.0/display/ADES/((ActiveBOM))_AD</a>
</p>
<img src="{{asset('/img/doc/activbom.jpg')}}" style="margin-top: 20px">

@endsection