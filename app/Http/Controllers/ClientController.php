<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

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

    public function cart()
    {
        return view('client.cart');
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