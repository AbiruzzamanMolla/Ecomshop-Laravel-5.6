<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function cart(){
        return view('pages.cart');
    }
    public function addToCart(Request $request){
        $qty = $request->qty;
        $product_id = $request->product_id;
        $product_info = DB::table('tbl_products')
            ->where('product_id', $product_id)
            ->first();
        $data['qty'] = $qty;
        $data['id'] = $product_info->product_id;
        $data['name'] =  $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/cart');
    }

    public function deleteCart(Request $request){
        Cart::remove($request->rowId);
        return Redirect::to('/cart');
    }

    public function resyncCartProduct(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        return Redirect::to('/cart');
    }
    public function checkout(){
        return view('pages.checkout');
    }
}
