<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    public function addBanner(Request $request)
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

        Banner::create([
            'image' => $path . $filename,
            'description' => $validated['description'],
            'shop_id' => session('business_id')
        ]);

        return redirect()->route('banner.add')->with('success', 'Banner added successfully!');
    }


    public function showForm()
    {
        $banner = Banner::where('shop_id', session('business_id'))->get();
        return view('addBanner', compact('banner'));
    }
}
