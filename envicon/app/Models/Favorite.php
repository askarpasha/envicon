<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id',];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
