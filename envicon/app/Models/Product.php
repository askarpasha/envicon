<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'product_code',
        'cost',
        'description',
        'image',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsFavoritedAttribute()
{
    if (!Auth::check()) {
        return false;
    }

    return $this->favorites()->where('user_id', Auth::id())->exists();
}




    public function favorites()
{
    return $this->hasMany(Favorite::class);
}
}
