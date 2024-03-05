<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    //
    public function home()
    {
        $sliders = Slider::all()->where('status', 1);

        $products = Product::all()->where('status', 1);

        return view('client.home', compact('sliders', 'products'));
    }

    public function shop()
    {
        $categories = Category::all();

        $products = Product::all()->where('status', 1);

        return view('client.shop', compact('categories', 'products'));
    }


    public function addtocart($id)
    {
        $product = Product::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        // dd(Session::get('cart'));
        return back();
    }

    public function updateqty(Request $request, $id)
    {
        //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return back();
    }

    public function cart()
    {
        if(!Session::has('cart')){

            return view('client.cart');
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        return view('client.cart', ['products' => $cart->items]);
    }

     public function removeFromCart($product_id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($product_id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return redirect()->route('cart');
    }

    public function checkout()
    {

        if(!Session::has('client')){

            return view('client.login');
        }

        if (!Session::has('cart')) {

            return view('client.cart');
        }

        return view('client.checkout');
    }

    public function login()
    {
        return view('client.login');
    }

    public function logout()
    {
        Session::forget('client');

        return redirect()->route('shop');
    }

    public function signup()
    {
        return view('client.signup');
    }

    public function create_account(Request $request)
    {
        $request->validate([
            'email' => 'email|required|unique:clients',
            'password' => 'required|min:4'
        ]);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with('status', 'Your account has been  successfully created.');
    }

    public function access_account(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $client = Client::where('email', $request->input('email'))->first();

        if($client){

            if(Hash::check($request->input('password'), $client->password)){

                Session::put('client', $client);

                return redirect('/shop');

            }else{

                return back()->with('status', 'Wrong email or password.');
            }
        }
        else{

            return back()->with('status', 'You don\'t  have an account with this email.');
        }
    }

    public function postcheckout(Request $request)
    {

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $order = new Order();

        $order->name = $request->input('name');

        $order->address = $request->input('address');

        $order->cart = serialize($cart);


       $order->save();

        // clear cart and empty cart
        Session::forget('cart');

        return redirect('/cart')->with('status', 'Your purchase has been  successfully completed.');
    }

    public function orders()
    {
        $orders = Order::all();

         $orders->transform(function ($order ,$key){

            $order->cart = unserialize($order->cart);

            return $order;
        });

        return view('admin.orders', compact('orders'));
    }


}