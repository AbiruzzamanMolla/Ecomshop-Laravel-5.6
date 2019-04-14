<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{
    public function addCategory(){
        return view("admin.add_category");
    }
    public function viewCategory(){
        $all_category_info = DB::table('tbl_category')->get();
        $show_all = view('admin.all_category')->with('all_category_info', $all_category_info);
        return view('admin_layout')->with('admin.all_category', $show_all);
    }
    public function saveCategory(Request $post){
        $data = array();
        $data['category_id'] = $post->category_id;
        $data['category_name'] = $post->category_name;
        $data['category_description'] = $post->category_description;
        $data['publication_status'] = $post->publication_status;

        DB::table('tbl_category')->insert($data);
        Session::put('msg','Category added succesfully!');
        return Redirect::to('/all-category');
    }

    public function inactiveCategory($category_id){
        DB::table('tbl_category')->where('category_id', $category_id)->update(['publication_status' => 0]);
        Session::put('msg','Category status changed!!');
        return Redirect::to('/all-category');
    }
    public function activeCategory($category_id){
        DB::table('tbl_category')->where('category_id', $category_id)->update(['publication_status' => 1]);
        Session::put('msg','Category status changed!!');
        return Redirect::to('/all-category');
    }
    public function viewCategoryId($category_id){
        $category_info = DB::table('tbl_category')->where('category_id', $category_id)->first();
        $show = view('admin.update_category')->with('category_info', $category_info);
        return view('admin_layout')->with('admin.update_category', $show);
    }
    public function updateCategory(Request $request, $category_id){
        $data=array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        DB::table('tbl_category')->where('category_id', $category_id)->update($data);
        Session::put('msg','Category updated successfully!!');
        return Redirect::to('/all-category');
    }
    public function deleteCategory($category_id){
        DB::table('tbl_category')->where('category_id', $category_id)->delete();
        Session::put('msg','Category successfully deleted!!');
        return Redirect::to('/all-category');
    }


}
