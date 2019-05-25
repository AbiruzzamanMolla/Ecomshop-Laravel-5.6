<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Session;
session_start();

class HomeController extends Controller
{
    public function index(){
        $all_published_product = DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_manufecture','tbl_products.manufecture_id','=','tbl_manufecture.manufecture_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_manufecture.manufecture_name')
            ->where('tbl_products.publication_status', 1)
            ->where('tbl_products.deleted_at', 0)
            ->limit(9)
            ->get();
        $show_all = view('pages.home_content')->with('all_published_product', $all_published_product);
        return view('layout')->with('pages.home_content', $show_all);
    }
}
