<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products
        return view('welcome', compact('products'));
    }
}

