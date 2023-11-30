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

    public function edit(Stock $stock)
{
    $products = Product::all(); // Assuming you need products for the dropdown
    return view('stocks.edit', compact('stock', 'products'));
}

public function update(Request $request, Stock $stock)
{
    // Validate and handle the original stock update logic if necessary
    // Since the fields are read-only, this might not be needed.

    // Now handle the "Add More" part
    if ($request->has('new_supplier_name')) {
        $additionalStockData = $request->validate([
            'new_supplier_name' => 'required|string|max:255',
            'new_quantity_added' => 'required|integer',
            'new_added_date' => 'required|date',
        ]);

        // Create a new stock entry for the same product
        Stock::create([
            'product_id' => $stock->product_id, // Assuming the new stock is for the same product
            'supplier_name' => $additionalStockData['new_supplier_name'],
            'quantity_added' => $additionalStockData['new_quantity_added'],
            'last_added_date' => $additionalStockData['new_added_date'],
        ]);

        // Update product's quantity
        $product = Product::find($stock->product_id);
        if ($product) {
            $product->quantity += $additionalStockData['new_quantity_added'];
            $product->save();
        }
    }

    return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
}



public function destroy(Stock $stock)
{
    // Optionally adjust product's quantity before deleting the stock

    // Delete the stock entry
    $stock->delete();

    return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully');
}



    
}
