<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $stocks = Stock::with('product')->get(); // Fetch all stocks with related product
        $products = Product::all(); // Fetch all products
    
        return view('stocks.index', compact('stocks', 'products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_name' => 'required|string',
            'quantity_added' => 'required|integer', // Assuming this is the added stock quantity
            'last_added_date' => 'required|date', // Ensure this field matches your form and database
        ]);
    
        // Create a new stock entry
        $stock = Stock::create($validatedData);
    
        // Find the product and update its quantity
        $product = Product::find($validatedData['product_id']);
        if ($product) {
            $product->quantity += $validatedData['quantity_added'];
            $product->save();
        } else {
            // Optionally handle the case where the product doesn't exist
            // For example, you could return an error message
            return redirect()->back()->withErrors('Product not found.');
        }
    
        return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
    }
    
}
