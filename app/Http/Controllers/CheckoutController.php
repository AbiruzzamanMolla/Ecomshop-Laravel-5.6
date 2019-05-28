<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

session_start();

class CheckoutController extends Controller
{
    public function checkout(){
            return view('pages.checkout');

        return Redirect::to('/login-check');
    }
    public function login(){
        return view('pages.login');
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/login-check');
    }

    public function customerRegistation(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customers')
            ->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return Redirect::to('/checkout');
    }

    public function saveShippingDetails(Request $request){
        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_city'] = $request->shipping_city;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shippings')
            ->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function customerLogin(Request $request){
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);

        $login = DB::table('tbl_customers')
                ->where('customer_email', $customer_email)
                ->where('customer_password', $customer_password)
                ->first();
        if($login){
            session::put('customer_id', $login->customer_id);
            return Redirect::to('/checkout');
        } else {
            session::put('msg', 'Invalid Email or Password!');
            return Redirect::to('/login-check');
        }
        exit();

    }
}
