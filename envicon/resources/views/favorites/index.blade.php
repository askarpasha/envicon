@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <h3>Favorites List</h3>
        @foreach($favorites as $favorite)
            <div class="col-6 col-md-2 mb-4">
                <div class="card h-100 product-animation">
                    <img src="{{ asset('storage/' . $favorite->product->image) }}" class="card-img-top" alt="{{ $favorite->product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $favorite->product->name }}</h5>
                        <!-- Other product details -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection


