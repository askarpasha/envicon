@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- User List Dropdown --}}
        <div class="form-group">
            <label for="user_id">User</label>
            <select class="form-control" id="user_id" name="user_id" readonly>
            @foreach ($users as $user)
              <option value="{{ $user->id }}" {{ auth()->id() == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
             @endforeach
            </select>
        </div>

        {{-- Category Dropdown --}}
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Name of Product --}}
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        {{-- Product Code --}}
        <div class="form-group">
            <label for="product_code">Product Code</label>
            <input type="text" class="form-control" id="product_code" name="product_code" required>
        </div>

        {{-- Cost --}}
        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="number" class="form-control" id="cost" name="cost" required>
        </div>

        {{-- Quantity --}}
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        {{-- Image Upload --}}
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        {{-- Save Button --}}
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
