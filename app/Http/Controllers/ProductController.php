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

    // Add Product to the system
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

    // Delete Product
    public function destroy(Product $product)
    {
        if (file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();
        return redirect()->route('showForm')->with('success', 'Product deleted successfully.');
    }

    public function edit(Product $product)
    {
        return view('promotions.addProduct', compact('product'));
    }

    public function update(Request $request, Product $product)
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
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $product->image = $path . $filename;
        }

        // Update promotion data
        $product->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'dis_price' => $validated['dis_price'],
            'loy_price' => $validated['loy_price'],
            'end_date' => $validated['end_date'],
            'business_id' => $validated['business'],
            'image' => $promotion->image ?? $path . $filename
        ]);

        return redirect()->route('showForm')->with('success', 'Product updated successfully!');
    }
}
