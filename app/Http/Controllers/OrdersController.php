<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\YProjects\order;
use App\YProjects\manufacturer;
use Sentinel;
use Mail;
class OrdersController extends Controller
{
	

	public function quotation($id)
	{

		$order = order::find($id);
		if (!$order->checkOwner()) {
			return redirect()->back()->withErrors('You are not the owner of this order');
		} 

		if ($order->status != 1) {
			return false;
		}

		$order->qty = Input::get('qty');
		$manuf = manufacturer::find(Input::get('manufacturer'));
		$order->manufacturer_id = Input::get('manufacturer');
		$order->save();
		

		if (Input::get('sendmail') == '1' || Input::get('sendmail') == 'on') {
			
			$json_file = Input::file("json");
			$json_extension = pathinfo($json_file->getClientOriginalName(), PATHINFO_EXTENSION);
			if (strcasecmp($json_extension, 'json') <> 0) {
				return redirect()->back()->withErrors('JSON File Type mismatch');
			}
			$attachment = Input::file('attachment');
			$attachment_extension = pathinfo($attachment->getClientOriginalName(), PATHINFO_EXTENSION);
			if (strcasecmp($attachment_extension, 'zip') <> 0) {
				return redirect()->back()->withErrors('Only Zip Files are accepted as attachment');
			}
			$json=json_decode(file_get_contents($json_file));
			if ($json->attachment != $attachment->getClientOriginalName()) {
				return redirect()->back()->withErrors('Wrong Zip File Selected');
			}
			$attachment->move(storage_path('/tmp/orderZip/'), $attachment->getClientOriginalName());
			$json->qty = Input::get('qty');
			$json->delivery = Input::get('delivery');
			$filename = storage_path('/Uploads/orders/order/json/') . $json->project . '_'. $order->type . '.json';
			$server_json = fopen($filename, "w");
			fwrite($server_json, json_encode($json));
			fclose($server_json);
			$order->jsonpath = $filename;
			$order->sendQuotMail($json);
		}
			$order->status = 2;
			$order->quot_date = date("Y-m-d");
			$order->save();

		return redirect()->back()->withSuccess('Quotation ready');


	}

	public function offer($id)
	{

		$order = order::find($id);
		if (!$order->checkOwner()) {
			return redirect()->back()->withErrors('You are not the owner of this order');
		} 
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
		$order->sendPORMail();
		return redirect()->back()->withSuccess('Offer updated');
	}

	public function approve($id)
	{
		$order = order::find($id);
		if ($order->status != 3) {
			return false;
		}
		$user = Sentinel::getUser();

		$credentials = ['email'=>$user->email, 'password'=>Input::get('password')];

		if(!Sentinel::validateCredentials($user, $credentials))	{
			return redirect()->back()->withErrors('wrong password');
		}
		if (!$user->hasAccess('POR')) {
			return redirect()->back()->withErrors('You have no permission to approve this order');
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
		if (!$order->checkOwner()) {
			return redirect()->back()->withErrors('You are not the owner of this order');
		} 
		if ($order->status != 4) {
			return false;
		}
		$file_content = file_get_contents(Input::file('order_json'));
		// $filename = Input::file('order_json')->getClientOriginalName();
		// $destination = storage_path('Uploads/orders/order/json/');
		// Input::file('order_json')->move($destination, $filename);
		// $file_content = file_get_contents($destination .'/'. $filename);
		$json = json_decode($file_content, true);
		dd($json);
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
		if (!$order->checkOwner()) {
			return redirect()->back()->withErrors('You are not the owner of this order');
		} 
		$user = Sentinel::getUser();
		
		$credentials = ['email'=>$user->email, 'password'=>Input::get('password')];

		if(!Sentinel::validateCredentials($user, $credentials))	{
			return redirect()->back()->withErrors('wrong password');
		}
		$order->status = 6;
		$order->save();
		return redirect()->back()->withSuccess('Order Cancelled');
	}

	
}
