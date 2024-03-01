<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
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

    public function cart()
    {
        if(!Session::has('cart')){

            return redirect('/cart');
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        return view('client.cart', ['products' => $cart->items]);
    }

    public function checkout()
    {

        return view('client.checkout');
    }

    public function login()
    {
        return view('client.login');
    }

    public function signup()
    {
        return view('client.signup');
    }

    public function orders()
    {
        return view('admin.orders');
    }
}