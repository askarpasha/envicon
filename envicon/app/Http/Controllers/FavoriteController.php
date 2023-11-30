<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        // Fetch favorite products for the logged-in user
        $user = Auth::user();
        $favorites = $user->favorites; // Assuming you have a 'favorites' relationship defined in your User model

        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $productId = $request->product_id;

        // Check if already favorited
        $existingFavorite = Favorite::where('user_id', $userId)->where('product_id', $productId)->first();
        if (!$existingFavorite) {
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
        }

        return back(); // Or return a response for an AJAX request
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
