<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Business;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //

    public function showForm()
    {
        $business = Business::where('id', session('business_id'))->first();
        $description = $business->description;
        $banner = About::where('shop_id', session('business_id'))->first() ?? new About();
        return view('about', compact('description', 'banner'));
    }

    // Insert About Us Section
    public function addAbout(Request $request)
    {
        $validated = $request->validate([
            'description' => 'nullable|string',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:10240',
        ]);

        $path = '';
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $path = 'uploads/banner/';
            $file->move($path, $filename);
        }

        About::create([
            'image' => $path . $filename,
            'shop_id' => session('business_id')
        ]);

        return redirect()->route('about')->with('success', 'Banner added successfully!');
    }
}
