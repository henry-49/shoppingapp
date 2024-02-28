<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //

    public function sliders()
    {
        $sliders = Slider::All();
        return view('admin.sliders', compact('sliders'));
    }

    public function addslider()
    {

        return view('admin.addslider');
    }

    public function saveslider(Request $request)
    {
        $request->validate([
            'description_1' => 'required',
            'description_2' => 'required',
            'slider_image' => 'required|mimes:jpeg,png,jpg|max:1999',
        ]);

            // get file name with extension
            $filenameWithExt = $request->file('slider_image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // get just file extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            // file name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);


        $slider  = new Slider();
        $slider->description_1 = $request->input('description_1');
        $slider->description_2 = $request->input('description_2');
        $slider->status = 1;

        $slider->slider_image = $fileNameToStore;

        $slider->save();

        // Session::put('success', 'category added successfully');

        return redirect('/sliders')->with('status', 'The slider  was added successfully.');

    }

    public function editslider($id)
    {
        $slider = Slider::find($id);

        return view('admin.edit_slider', compact('slider'));
    }

    public function updateslider(Request $request)
    {

        $request->validate([
            'description_1' => 'required',
            'description_2' => 'required',
            'slider_image' => 'mimes:jpeg,png,jpg|max:1999',
        ]);

        $slider  = Slider::find($request->input('id'));

        $slider->description_1 = $request->input('description_1');
        $slider->description_2 = $request->input('description_2');

        if ($request->hasFile('slider_image')) {

            // get file name with extension
            $filenameWithExt = $request->file('slider_image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // get just file extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            // file name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

            Storage::delete('public/slider_images/' . $slider->slider_image);

            $slider->slider_image = $fileNameToStore;
        }

        $slider->update();

        return redirect('/sliders')->with('status', 'The slider has been updated successfully.');
    }

    public function activate_slider($id)
    {
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->update();

        return back()->with('status', 'The slider has been activated successfully.');
    }

    public function unactivate_slider($id)
    {

        $slider = Slider::find($id);
        $slider->status = 0;

        $slider->update();

        return back()->with('status', 'The slider has been deactivated successfully.');
    }

    public function deleteslider($id)
    {
        //
        $slider = Slider::find($id);


        Storage::delete('public/slider_images/' . $slider->slider_image);

        $slider->delete();

        return redirect('/sliders')->with('status', 'The slider has been deleted Successfuly!');;
    }

}