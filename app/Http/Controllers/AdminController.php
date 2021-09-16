<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index()
    {
   
        return view('admin/index');
    }



    public function orders()
    {     
        return view('admin/orders');
    }
    public function getOrders()
    {     
        $res = DB::table('orders as o')->select('o.*')->get();
        return $res;
      
    }
}
