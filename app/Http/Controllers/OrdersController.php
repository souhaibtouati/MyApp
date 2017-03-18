<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class OrdersController extends Controller
{
    public function quotation($id)
    {
    	dd(Input::all());
    }

    public function offer($id)
    {
    	# code...
    }

    public function approve($id)
    {
    	# code...
    }

    public function order($id)
    {
    	# code...
    }

    public function delivery($id)
    {
    	# code...
    }

    public function cancel($id)
    {
    	# code...
    }
}
