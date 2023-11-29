<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // Create a new category
        $category = new Category;
        $category->name = $request->name;
        $category->save();

        // Redirect to the categories list with a success message
        return redirect()->route('category-listing')
                         ->with('success', 'Category created successfully.');
    }
}
