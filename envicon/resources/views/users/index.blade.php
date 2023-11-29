@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Listing</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><img src="{{ asset(str_replace('public/', '', $user->image)) }}" alt="User Image" width="50" height="50">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        <a href="" class="btn btn-primary">Edit</a>
                        <button onclick="" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function deleteUser(userId) {
        // Implement user deletion logic here, e.g., show confirmation and send a delete request
    }
</script>
@endsection
