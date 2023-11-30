@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Favorites</h2>
    @foreach($favorites as $favorite)
    <div>
        <h3>{{ $favorite->product->name }}</h3>
        <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="{{ $favorite->product->name }}">
        {{-- Other product details --}}
    </div>
@endforeach
</div>
@endsection
