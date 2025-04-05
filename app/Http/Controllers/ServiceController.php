<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serivce;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    //
    public function showService()
    {
        return view('services.addservice');
    }

    public function getAllService()
    {
        $id = Auth::user()->id;
        $promotions = Serivce::where('NIC', $id)->get();
        return view('services.viewservice', compact('promotions'));
    }

    // Method to Add Services
    public function addService(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'dis_price' => 'required|numeric|min:0',
            'nic' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,jpeg,webp'
        ]);

        // Add image to upload/service route
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $path = 'uploads/services/';
            $filename = time() . "." . $extension;

            $file->move($path, $filename);
        }

        // Add promotion to the promotion table
        Serivce::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'dis_price' => $validated['dis_price'],
            'NIC' => $validated['nic'],
            'image' => $path . $filename
        ]);


        // Redirect to promotion view
        return redirect()->route('service.add')->with('success', 'Service Added successfully!');
    }

    public function destroy(Serivce $promotion)
    {
        if (file_exists(public_path($promotion->image))) {
            unlink(public_path($promotion->image));
        }
        $promotion->delete();
        return redirect()->route('viewservice')->with('success', 'Promotion deleted successfully.');
    }

    public function edit(Serivce $promotion)
    {
        return view('services.addservice', compact('promotion'));
    }

    public function update(Request $request, Serivce $promotion)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'dis_price' => 'required|numeric|min:0',
            'nic' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $path = 'uploads/services/';
            $filename = time() . "." . $extension;
            $file->move($path, $filename);

            if (file_exists(public_path($promotion->image))) {
                unlink(public_path($promotion->image));
            }

            $promotion->image = $path . $filename;
        }

        // Update promotion data
        $promotion->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'dis_price' => $validated['dis_price'],
            'NIC' => $validated['nic'],
            'image' => $promotion->image ?? $path . $filename
        ]);

        return redirect()->route('viewservice')->with('success', 'Service updated successfully!');
    }
}
