<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Illuminate\Support\Facades\DB;
 
use App\Models\Order;
use App\Models\Order_Detail;
 

use Auth;
class OrdersController extends Controller
{
    public function submitOrder(Request $request)
    {
            $delivery_address=$request->request->get('delivery_address');
            $payment_method=$request->request->get('payment_method');
            $customer_name=$request->request->get('customer_name');
            $customer_phone=$request->request->get('customer_phone');
            
        $cart = session()->get('cart');
     
     
        $total=0;

        $details = [];


          $user = Order::create([
            'customer_id' => '1',
            'delivery_address' => $delivery_address,
            'payment_method'=>$payment_method,
            'total' => $total,
            'status' => 'Open',
            'customer_name'=>Auth::user()->name,
            'customer_phone'=>$customer_phone,
            'user_id'=>Auth::user()->id

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



    public function customerOrders(){

      $orders = DB::table('orders as o')->select('o.*')->get();
      
      return view('customer_orders',compact('orders'));
    }
    public function updateStatus(Request $request)
    {
      try{

     
      $id=$request->request->get('id');
      $status=$request->request->get('status');

      $order = Order::find($id);
      $order->status = $status;
      $order->save();
     
    }catch(exception $e){
      return response()->json([
        'success'=>true,
        'message' => $e->getMessage()  
    ]);
    }
      return response()->json([
        'success'=>true,
        'message' => "Order updated"    
    ]);
    }

    public function receipt(Request $request, $id )
    {
     return view('receipt',compact('id'));
   
    }
  
}
