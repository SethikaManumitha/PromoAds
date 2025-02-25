<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function getAllProduct()
    {
        $products = Product::where('shop_id', session('business_id'))->get();
        return view('products.viewproduct', compact('products'));
    }

    public function showForm()
    {
        return view('products.addproduct');
    }

    public function addProduct(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'availability' => 'nullable|string',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:10240',
        ]);

        // Handle image upload
        $path = '';
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $path = 'uploads/products/';
            $file->move($path, $filename);
        }

        // Add product to the database
        Product::create([
            'shop_id' => session('business_id'),
            'name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'special_price' => $validated['sale_price'],
            'image' => $path . $filename,
        ]);

        // Redirect with success message
        return redirect()->route('product.add')->with('success', 'Product added successfully!');
    }
}
