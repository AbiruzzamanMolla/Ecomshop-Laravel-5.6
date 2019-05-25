<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{
    public function adminAuth(){
        $admin_id = Session::get('admin_id');
        if(!$admin_id){
            return Redirect::to('/admin')->send();
        }
    }

    public function index(){
        $this->adminAuth();
        return view('admin.slider_manager');
    }
    public function saveSlider(Request $request){
        $this->adminAuth();
        $data = array();
        $data['slider_image']=$request->file('slider_image');
        $data['publication_status']=$request->publication_status;
        $image = $data['slider_image'];
        if($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'slider/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path, $image_full_name);
            if($success){
                $data['slider_image']=$image_url;

                DB::table('tbl_sliders')->insert($data);
                Session::put('msg','Slider added Succesfully!');
                return Redirect::to('/slider-manager');
            } else{
                Session::put('msg','Failed!');
                return Redirect::to('/slider-manager');
            }
        }
    }

    public function viewSlider(){
        $this->adminAuth();
        $all_slider_info = DB::table('tbl_sliders')->get();
        $show_all = view('admin.slider_manager')->with('all_slider_info', $all_slider_info);
        return view('admin_layout')->with('admin.slider-manager', $show_all);
    }

    public function inactiveSlider($slider_id){
        $this->adminAuth();
        DB::table('tbl_sliders')->where('slider_id', $slider_id)->update(['publication_status' => 0]);
        Session::put('msg','Slider status changed!!');
        return Redirect::to('/slider-manager');
    }
    public function activeSlider($slider_id){
        $this->adminAuth();
        DB::table('tbl_sliders')->where('slider_id', $slider_id)->update(['publication_status' => 1]);
        Session::put('msg','Slider status changed!!');
        return Redirect::to('/slider-manager');
    }
    public function deleteSlider($slider_id){
        $this->adminAuth();
        DB::table('tbl_sliders')->where('slider_id', $slider_id)->delete();
        Session::put('msg','Category successfully deleted!!');
        return Redirect::to('/slider-manager');
    }
}
