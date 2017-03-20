<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\YProjects\order;
use App\YProjects\manufacturer;
use Sentinel;

class OrdersController extends Controller
{
	public function quotation($id)
	{
		$order = order::find($id);

		if ($order->status != 1) {
			return false;
		}
		else{
			$order->qty = Input::get('qty');
			$manuf = manufacturer::find(Input::get('manufacturer'));
			$order->status = 2;
			$order->quot_date = date("Y-m-d");
			$order->save();
			$order->manufacturer()->save($manuf);

			return redirect()->back()->withSuccess('Quotation ready');

		}
	}

	public function offer($id)
	{

		$order = order::find($id);
		if ($order->status != 2) {
			return false;
		}
		$order->Initial_cost = Input::get('Initial_cost');
		$order->cost_piece = Input::get('cost_piece');

		$filename = Input::file('offer_pdf')->getClientOriginalName();
		$destination = public_path('/yprojects/orders/offers');

		$order->offer_pdf = asset('/yprojects/orders/offers/') . '/' . $filename;

		Input::file('offer_pdf')->move($destination, $filename);
		$order->status = 3;
		$order->offer_date = date('Y-m-d');
		$order->save();
		return redirect()->back()->withSuccess('Offer updated');
	}

	public function approve($id)
	{
		$order = order::find($id);
		if ($order->status != 3) {
			return false;
		}
		$user = Sentinel::getUser();
		if (!$user->hasAccess('POR')) {
			return redirect()->back()->withErrors('You do not have the right to approve this order');
		}
		$credentials = ['email'=>$user->email, 'password'=>Input::get('password')];

		if(!Sentinel::validateCredentials($user, $credentials))	{
			return redirect()->back()->withErrors('wrong password');
		}
		$order->approv_date = date('Y-m-d');
		$order->approv_by = $user->initials;
		$order->status = 4;
		$order->save();

		return redirect()->back()->withSuccess('Order Approved');
		
	}

	public function order($id)
	{
		$order = order::find($id);
		if ($order->status != 4) {
			return false;
		}
	}

	public function delivery($id)
	{
		$order = order::find($id);
		if ($order->status != 4) {
			return false;
		}
	}

	public function cancel($id)
	{
		$order = order::find($id);
		$user = Sentinel::getUser();

		if ($order->owner != $user->id) {
			return redirect()->back()->withErrors('Only order owner can cancel it');
		}
		$credentials = ['email'=>$user->email, 'password'=>Input::get('password')];

		if(!Sentinel::validateCredentials($user, $credentials))	{
			return redirect()->back()->withErrors('wrong password');
		}
		$order->status = 6;
		$order->save();
		return redirect()->back()->withSuccess('Order Cancelled');
	}

}
