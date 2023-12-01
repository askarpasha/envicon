@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Stock</h2>
    <form method="POST" action="{{ route('stocks.update', $stock->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Product Dropdown --}}
        <div class="form-group">
            <label for="product_name">Product</label>
            <input type="text" class="form-control" id="product_name" value="{{ $stock->product->name }}" readonly>
        </div>
        <h4 class="pt-3 underlined-label">Last Added Section</h4>
        {{-- Supplier Name --}}
        <div class="row pb-3">
            <div class="col-md-4 form-group">
                <label for="supplier_name">Supplier Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $stock->supplier_name }}" readonly>
            </div>

            <div class="col-md-4 form-group">
                <label for="quantity_added">Quantity Added</label>
                <input type="number" class="form-control" id="quantity_added" name="quantity_added" value="{{ $stock->quantity_added }}" readonly>
            </div>

            <div class="col-md-4 form-group">
                <label for="last_added_date">Last Added Date</label>
                <input type="date" class="form-control" id="last_added_date" name="last_added_date" 
                       value="{{ \Carbon\Carbon::parse($stock->last_added_date)->format('Y-m-d') }}" readonly>
            </div>
        </div>
<button type="button" class="btn btn-info" id="addMoreButton">Add More</button>

 {{-- Additional Fields (Initially Hidden) --}}
 <div id="additionalFields" style="display: none;">
    <h3 class="pt-5">Add More Stock</h3>
    {{-- New Supplier Name --}}
    <div class="form-group">
        <label for="new_supplier_name">Name of Supplier2</label>
        <input type="text" class="form-control" id="new_supplier_name" name="new_supplier_name">
    </div>

    {{-- New Quantity --}}
    <div class="form-group">
        <label for="new_quantity_added">Quantity</label>
        <input type="number" class="form-control" id="new_quantity_added" name="new_quantity_added">
    </div>

    {{-- New Date --}}
    <div class="form-group">
        <label for="new_added_date">Date</label>
        <input type="date" class="form-control" id="new_added_date" name="new_added_date">
    </div>

    {{-- Save Button for New Stock --}}
    <button type="submit" class="btn btn-primary">Save</button>
</div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#addMoreButton').click(function() {
            $('#additionalFields').show();
        });
    });
</script>
@endsection

@push('styles')
<style>
    .underlined-label {
        text-decoration: underline;
    }
</style>
@endpush