<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    // list all products
    public function products()
    {
        $products = Product::all();

        return view('admin.products', compact('products'));
    }

    public function addproduct()
    {
        $categories = Category::all()->pluck('category_name', 'category_name');
        //$categories = Category::all();

        return view('admin.addproduct', compact('categories'));
    }

    public function saveproduct(Request $request)
    {
        //dd($request->input("product_image"));

         $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'mimes:jpeg,png,jpg|nullable|max:1999',
        ]);

        if ($request->hasFile('product_image')) {
            // get file name with extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // get just file extension
            $extension = $request->file('product_image')->getClientOriginalExtension();

            // file name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        } else {

            $fileNameToStore = 'no_image.jpg';
        }

        $product  = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->status = 1;

        $product->product_image = $fileNameToStore;

        $product->save();

        // Session::put('success', 'category added successfully');

        return back()->with('status', 'The product name was added successfully.');
    }


    public function editproduct($id)
    {
        $product = Product::find($id);
        $categories = Category::all()->pluck('category_name', 'category_name');

        return view('admin.edit_product', compact('product', 'categories'));
    }

    public function updateproduct(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'mimes:jpeg,png,jpg|nullable|max:1999',
        ]);

        $product  = Product::find($request->input('id'));

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');

        if ($request->hasFile('product_image')) {
            // get file name with extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // get just file extension
            $extension = $request->file('product_image')->getClientOriginalExtension();

            // file name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            if ($product->product_image != 'no_image.jpg'){
                Storage::delete('public/product_images/'.$product->product_image);
            }

            $product->product_image = $fileNameToStore;
        }

        $product->update();

        return redirect('/products')->with('status', 'The product has been updated successfully.');
    }

    public function deleteproduct($id)
    {
        $product = Product::find($id);

        if ($product->product_image != 'no_image.jpg') {
            Storage::delete('public/product_images/' . $product->product_image);
        }

        $product->delete();

        return back()->with('status', 'The product has been deleted successfully.');

    }

    public function activate_product($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->update();

        return back()->with('status', 'The product has been activated successfully.');
    }

    public function unactivate_product($id)
    {

        $product = Product::find($id);
        $product->status = 0;

        $product->update();

        return back()->with('status', 'The product has been deactivated successfully.');
    }

    

   /*  public function validateImage(Request $request) {
        $request->validate([
            'product_image' => 'image|nullable|mimes:jpg,jpeg,png|max:1999',
        ]);

        return redirect()->back();
    } */



}