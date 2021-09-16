<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{
    public function receipt(Request $request, $id){

       
        //  $order_id=$request->request->get('id');
        $order_id=$id;
          $res = DB::table('orders as o')->select('o.*','p.name','d.product_id','d.qty','d.price', 'd.sub_total')
            ->join('order__details as d','o.id','=','d.order_id') 
            ->join('products as p','d.product_id','=','p.id')
            ->where('o.id', $order_id)->get();
  
  
            return $res;
      }



      public function orders(){

       
       
          $res = DB::table('orders as o')->select('o.*','p.name','d.product_id','d.qty','d.price', 'd.sub_total')
            ->join('order__details as d','o.id','=','d.order_id') 
            ->join('products as p','d.product_id','=','p.id')->get();
  
  
            return $res;
      }
}
