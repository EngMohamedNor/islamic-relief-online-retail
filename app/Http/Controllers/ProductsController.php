<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
 
use App\Models\User;
use Hash;
use Auth;
class ProductsController extends Controller
{
    public function index()
    {

        $users = User::count();  
        if($users == 0){
                User::create([
                    'name' => 'Mr. Admin',
                    'email' => 'admin@gmail.com',
                    'role' => 'admin',
                    'password' => Hash::make('12345678'),
                ]);

            }
           

         


        $products = Product::all();
        return view('products', compact('products'));
    }
    public function cart()
    {
        $cart = session()->get('cart');
        if(!$cart) {
            return redirect("/");
        }

        if (!Auth::user()){
            return view('auth/login');
        }

        return view('cart');
    }
     


    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

 
        if(!$cart) {

            $cart = [
                    $id => [
                        "name" => $product->name,
                        "qty" => 1,
                        "price" => $product->price,
                        "photo" => $product->photo
                    ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to the cart successfully!');
        }

     
        if(isset($cart[$id])) {

            $cart[$id]['qty']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

      
        $cart[$id] = [
            "name" => $product->name,
            "qty" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function update(Request $request)
    {
        if($request->id and $request->qty)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["qty"] = $request->qty;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed from the cart');
        }
    }
}
