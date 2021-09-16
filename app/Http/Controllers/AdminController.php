<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class AdminController extends Controller
{
    public function index()
    {
        if(Auth::user()->role!=="admin"){
            return redirect('/')->with('error','Permission Denied!!! You do not have administrative access.');
    }  
        return view('admin/index');
    }


  
     
    public function orders()
    {   
        if(Auth::user()->role!=="admin"){
            return redirect('/')->with('error','Permission Denied!!! You do not have administrative access.');
    }  

        return view('admin/orders');
    }
    public function getOrders()
    {     
        $res = DB::table('orders as o')->select('o.*')->get();
        return $res;
      
    }
}
