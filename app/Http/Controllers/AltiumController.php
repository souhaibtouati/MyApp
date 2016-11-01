<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Altium\Capacitor;
use Webcreate\Vcs\Svn;

class AltiumController extends Controller
{
    public function index()
    {
        return view('Altium.category');
    }
    public function Test()
    {


    	// $repo = new Svn ("http://yed-muc-ed1/svn/AltiumDesign");
    	// $repo->setCredentials('souhaib.t', 'souhaibt_01');
    	// $repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
    	// dd($repo->ls("/B2062P02"));
    	
    	$cap = new Capacitor;
    	dd($cap->getTables());
    	return true;
    }
}
