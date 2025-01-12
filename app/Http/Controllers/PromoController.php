<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromoController extends Controller
{
    // Show promotion form
    public function showForm()
    {
        return view('promotions.addpromotion');
    }

    // Get promotions
    public function getPromo()
    {
        $promotions = Promotion::all();
        return view('promotions.viewpromotion', compact('promotions'));
    }

    // Add promotion
    public function addPromo(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'dis_price' => 'required|numeric|min:0',
            'end_date' => 'required|date',
            'business' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,jpeg,webp'
        ]);

        // Add image to upload/promtion route
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $path = 'uploads/promotions/';
            $filename = time() . "." . $extension;

            $file->move($path, $filename);
        }

        // Add promotion to the promotion table
        Promotion::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'dis_price' => $validated['dis_price'],
            'end_date' => $validated['end_date'],
            'business' => $validated['business'],
            'image' => $path . $filename
        ]);


        // Redirect to promotion view
        return redirect()->route('promo.add')->with('success', 'Promotion Added successfully!');
    }


    public function destroy(Promotion $promotion)
    {
        if (file_exists(public_path($promotion->image))) {
            unlink(public_path($promotion->image));
        }
        $promotion->delete();
        return redirect()->route('viewpromo')->with('success', 'Promotion deleted successfully.');
    }

    public function edit(Promotion $promotion)
    {
        return view('promotions.addpromotion', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'dis_price' => 'required|numeric|min:0',
            'loy_price' => 'required|numeric|min:0',
            'end_date' => 'required|date',
            'business' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        // Handle the image upload (only if a new one is provided)
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $path = 'uploads/promotions/';
            $filename = time() . "." . $extension;
            $file->move($path, $filename);

            // Delete the old image
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
            'loy_price' => $validated['loy_price'],
            'end_date' => $validated['end_date'],
            'business' => $validated['business'],
            'image' => $promotion->image ?? $path . $filename
        ]);

        return redirect()->route('viewpromo')->with('success', 'Promotion updated successfully!');
    }
}
