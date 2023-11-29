@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product Listing</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Image</th>
                <th>Name with Code</th>
                <th>Cost</th>
                <th>Quantity</th>
                <th>Stock Status</th>
                <th>Added by</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="50" height="50">
            @else
                No Image
            @endif
        </td>
                    <td>{{ $product->name }} ({{ $product->product_code }})</td>
                    <td>{{ $product->cost }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->quantity < 0 ? 'OUT OF STOCK' : 'IN STOCK' }}</td>
                    <td>{{ optional($product->user)->name ?? 'N/A' }}</td>
                    <td>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
