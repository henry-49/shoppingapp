<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    public function categories()
    {
        $categories = Category::all();

        return view('admin.categories', compact('categories'));
    }

    public function addcategory(){
        return view('admin.addcategory');
    }

    public function savecategory(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:categories|max:25'
        ]);

        $category  = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

        // Session::put('success', 'category added successfully');

        return back()->with('status', 'The category name was added successfully.');

    }

    public function editcategory(Request $request, $id)
    {
        $category = Category::find($id);

        return view('admin.edit_category', compact('category'));
    }

    public function updatecategory(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:categories|max:25',
        ]);

        $category = Category::find($request->input('id'));
        $category->category_name = $request->input('category_name');
        $category->save();

       return back()->with('status', 'The category name was updated successfully.');
    }

    public function deletecategory($id)
    {

        $category = Category::find($id);

        $category->delete();

        Session::put('success', 'category deleted successfully');

        return back()->with('status', 'The category name was deleted successfully.');

   }
}