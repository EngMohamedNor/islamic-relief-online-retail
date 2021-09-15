<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Illuminate\Support\Facades\DB;
 
use App\Models\Order;
use App\Models\Order_Detail;
 


class OrdersController extends Controller
{
    public function submit_order(Request $request)
    {
            $delivery_address=$request->request->get('delivery_address');

        $cart = session()->get('cart');
     
     
        $total=0;

        $details = [];


          $user = Order::create([
            'customer_id' => '1',
            'delivery_address' => $delivery_address,
            'total' => $total,
            'status' => 'Open',
        ]);
        $user->save();
        
        $order_id=Order::max('id') ;

        foreach( $cart as $key=>$cart){
         $total+=$cart["price"]*$cart["qty"];
            array_push($details, 
            array(
                'order_id' => $order_id,
                'product_id' => $key,
                'qty' => $cart["qty"],
                'price' => $cart["price"],
                'sub_total' => $cart["price"]*$cart["qty"]
            ));

           
          }
          Order_Detail::insert($details);


          $order = Order::find($order_id);
          
          //  $order = Order::where('order_id', '=', $order_id)->firstOrFail();

          $order->total = $total;
          
          $order->save();
          session()->put('cart', null);

          return response()->json([
            'order_id' => $order_id
            
        ]);

          
    }

    public function receipt(Request $request, $id )
    {
     return view('receipt',compact('id'));
   
    }
  
}
