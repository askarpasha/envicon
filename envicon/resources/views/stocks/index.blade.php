@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Stock List</h2>
    <button class="btn btn-primary" style="margin-bottom: 15px;" data-bs-toggle="modal" data-bs-target="#addStockModal">Add Stock</button>

    {{-- Stock Listing Table --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Product</th>
                <th>Supplier Name</th>
                <th>Quantity Added</th>
                <th>Last Added Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $index => $stock)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->supplier_name }}</td>
                    <td>{{ $stock->quantity_added }}</td>
              
                    <td>{{ \Carbon\Carbon::parse($stock->last_added_date)->format('Y-m-d') }}</td>

                    <td>
                        <div class="d-inline-flex">
                            <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-primary mr-2">Edit</a>
                            <form action="{{ route('stocks.destroy', $stock->id) }}" class="px-3" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<!-- Add Stock Modal -->
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('stocks.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockModalLabel">Add Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Product Dropdown --}}
                    <div class="form-group mb-3">
                        <label for="product_id" class="form-label">Product</label>
                        <select class="form-control" id="product_id" name="product_id">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Supplier Name --}}
                    <div class="form-group mb-3">
                        <label for="supplier_name" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
                    </div>

                    {{-- Quantity --}}
                    <div class="form-group mb-3">
                        <label for="quantity_added" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity_added" name="quantity_added" required>
                    </div>

                    {{-- Date --}}
                    <div class="form-group mb-3">
                        <label for="last_added_date" class="form-label">Date Added</label>
                        <input type="date" class="form-control" id="last_added_date" name="last_added_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>
@endsection
