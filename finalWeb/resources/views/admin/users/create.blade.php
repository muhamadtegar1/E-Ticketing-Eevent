@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
<div class="container">
    <h1 class="my-4">Create User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="1">Admin</option>
                <option value="2">Organizer</option>
                <option value="3">User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
