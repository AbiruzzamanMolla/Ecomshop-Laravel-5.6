<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class SuperAdminController extends Controller
{
    public function logout(){
        Session::flash();
        return Redirect::to('/admin');
    }
}
