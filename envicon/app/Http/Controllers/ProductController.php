<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $users = User::all(); // Fetch all users
        $categories = Category::all(); // Fetch all categories
        return view('products.create', compact('users', 'categories'));
    }

    public function index()
    {
        $products = Product::with('user')->get(); // Assuming each product has a user relation
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
{
    // Validate the input data
    $validatedData = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'product_code' => 'required|string|unique:products,product_code',
        'cost' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        'user_id' => 'required|exists:users,id',
        'quantity' => 'required|numeric',
    ]);

    // Handle image upload
    $imageName = null;
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $imageName = $request->file('image')->store('product_images', 'public'); // Storing image in storage/app/public/product_images
    }

    // Create a new product record
    $product = new Product;
    $product->fill($validatedData);
    $product->image = $imageName;
    $product->user_id = auth()->id(); // Set the user_id to the current logged-in user
    $product->save();

    // Redirect to a specific route with a success message
    return redirect()->route('products.create')->with('success', 'Product created successfully.');
}

public function edit(Product $product)
{
    $categories = Category::all(); // Assuming you need categories for the dropdown
    $users = User::all(); // Assuming you need users for the dropdown
    return view('products.edit', compact('product', 'categories', 'users'));
}

public function update(Request $request, Product $product)
{
    // Validate the request data
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'product_code' => 'required|string|unique:products,product_code,' . $product->id,
        'cost' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        // Delete old image if exists
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Store new image and get path
        $imageName = $request->file('image')->store('product_images', 'public');
        $validatedData['image'] = $imageName;
    }

    // Update the product with validated data
    $product->update($validatedData);

    // Redirect to a specific route with a success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


public function destroy(Product $product)
{
    // Delete the product
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully');
}



}
