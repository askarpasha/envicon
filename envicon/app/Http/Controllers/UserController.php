<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
{
    $users = User::all(); // Fetch all users
    return view('users.index', compact('users'));
}

    public function create()
    {
        return view('add-user');
    }
    
    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Assuming you want to allow image uploads
        ]);

      
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $imagePath = "public/images/" . $imageName;
        
        } else {
            $imagePath = null; // Default image or null if no image is uploaded
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status' => $validatedData['status'],
            'image' => $imagePath,
        ]);

        return redirect()->route('user-listing')->with('success', 'User created successfully.');
    
    }
    
}
