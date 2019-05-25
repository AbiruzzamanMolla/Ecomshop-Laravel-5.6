<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->adminAuth();
        return view('admin.dashboard');
    }

    public function dashboard(Request $post){
        $email = $post->admin_email;
        $password = md5($post->admin_password);
        $results = DB::table('tbl_admin')->where('admin_email',$email)->where('admin_password', $password)->first();
        if($results){
            session::put('admin_name', $results->admin_name);
            session::put('admin_id', $results->admin_id);
            return Redirect::to('/dashboard');
        } else {
            session::put('msg', 'Invalid Email or Password!');
            return Redirect::to('/admin');
        }
        exit();
    }
    public function adminAuth(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return;
        } else {
            return Redirect::to('/admin')->send();
        }
    }
}
