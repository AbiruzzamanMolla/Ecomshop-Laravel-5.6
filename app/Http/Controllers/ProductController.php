<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function adminAuth(){
        $admin_id = Session::get('admin_id');
        if(!$admin_id){
            return Redirect::to('/admin')->send();
        }
    }

    public function addProduct(){
        $this->adminAuth();
       return view('admin.add_product');
    }
    public function saveProduct(Request $request){
        $this->adminAuth();
        $data = array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufecture_id']=$request->manufecture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_image']=$request->file('product_image');
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['product_qty']=$request->product_qty;
        $data['publication_status']=$request->publication_status;

        $image = $data['product_image'];
        if($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path, $image_full_name);
            if($success){
                $data['product_image']=$image_url;

                DB::table('tbl_products')->insert($data);
                Session::put('msg','Product added Succesfully!');
                return Redirect::to('/all-product');
            } else {
                $data['product_image']='';
                DB::table('tbl_product')->insert($data);
                Session::put('msg','Product added Succesfully without image!');
                return Redirect::to('/all_product');
            }
        }
    }

    public function viewProduct(){
        $this->adminAuth();
        $all_product_info = DB::table('tbl_products')->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')->join('tbl_manufecture','tbl_products.manufecture_id','=','tbl_manufecture.manufecture_id')->select('tbl_products.*','tbl_category.category_name','tbl_manufecture.manufecture_name')->where('deleted_at', 0  )->get();
        $show_all = view('admin.all_product')->with('all_product_info', $all_product_info);
        return view('admin_layout')->with('admin.all_product', $show_all);
    }

    public function inactiveProduct($product_id){
        $this->adminAuth();
        DB::table('tbl_products')->where('product_id', $product_id)->update(['publication_status' => 0]);
        Session::put('msg','Product status changed!!');
        return Redirect::to('/all-product');
    }
    public function activeProduct($product_id){
        $this->adminAuth();
        DB::table('tbl_products')->where('product_id', $product_id)->update(['publication_status' => 1]);
        Session::put('msg','Product status changed!!');
        return Redirect::to('/all-product');
    }
    public function viewProductId($product_id){
        $this->adminAuth();
        $product_info = DB::table('tbl_products')->where('product_id', $product_id)->first();
        $show = view('admin.update_product')->with('product_info', $product_info);
        return view('admin_layout')->with('admin.update_product', $show);
    }
    public function updateProduct(Request $request, $product_id){
        $this->adminAuth();
        $data=array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufecture_id'] = $request->manufecture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['product_qty'] = $request->product_qty;
        DB::table('tbl_products')->where('product_id', $product_id)->update($data);
        Session::put('msg','Product updated successfully!!');
        return Redirect::to('/all-product');
    }
    public function deleteProduct($product_id){
        $this->adminAuth();
        $data = array();
        $data['deleted_at'] = 1;
        DB::table('tbl_products')->where('product_id', $product_id)->update($data);
        Session::put('msg','Product successfully deleted softly!!');
        return Redirect::to('/all-product');
    }
}
