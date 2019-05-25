<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
session_start();

class ManufectureController extends Controller
{
    public function adminAuth(){
        $admin_id = Session::get('admin_id');
        if(!$admin_id){
            return Redirect::to('/admin')->send();
        }
    }

    public function addManufecture(){
        $this->adminAuth();
        return view("admin.add_manufecture");
    }

    public function saveManufecture(Request $post){
        $this->adminAuth();
        $data = array();
        $data['manufecture_id'] = $post->manufecture_id;
        $data['manufecture_name'] = $post->manufecture_name;
        $data['manufecture_description'] = $post->manufecture_description;
        $data['publication_status'] = $post->publication_status;

        DB::table('tbl_manufecture')->insert($data);
        Session::put('msg','Manufecture added succesfully!');
        return Redirect::to('/all-manufecture');
    }
    public function viewManufecture(){
        $this->adminAuth();
        $all_manufecture_info = DB::table('tbl_manufecture')->get();
        $show_all = view('admin.all_manufecture')->with('all_manufecture_info', $all_manufecture_info);
        return view('admin_layout')->with('admin.all_manufecture', $show_all);
    }

    public function inactiveManufecture($manufecture_id){
        $this->adminAuth();
        DB::table('tbl_manufecture')->where('manufecture_id', $manufecture_id)->update(['publication_status' => 0]);
        Session::put('msg','Manufecture status changed!!');
        return Redirect::to('/all-manufecture');
    }
    public function activeManufecture($manufecture_id){
        $this->adminAuth();
        DB::table('tbl_manufecture')->where('manufecture_id', $manufecture_id)->update(['publication_status' => 1]);
        Session::put('msg','Manufecture status changed!!');
        return Redirect::to('/all-manufecture');
    }
    public function viewManufectureId($manufecture_id){
        $this->adminAuth();
        $manufecture_info = DB::table('tbl_manufecture')->where('manufecture_id', $manufecture_id)->first();
        $show = view('admin.update_manufecture')->with('manufecture_info', $manufecture_info);
        return view('admin_layout')->with('admin.update_manufecture', $show);
    }
    public function updateManufecture(Request $request, $manufecture_id){
        $this->adminAuth();
        $data=array();
        $data['manufecture_name'] = $request->manufecture_name;
        $data['manufecture_description'] = $request->manufecture_description;
        DB::table('tbl_manufecture')->where('manufecture_id', $manufecture_id)->update($data);
        Session::put('msg','Manufecture updated successfully!!');
        return Redirect::to('/all-manufecture');
    }
    public function deleteManufecture($manufecture_id){
        $this->adminAuth();
        DB::table('tbl_manufecture')->where('manufecture_id', $manufecture_id)->delete();
        Session::put('msg','Manufecture successfully deleted!!');
        return Redirect::to('/all-manufecture');
    }
}
