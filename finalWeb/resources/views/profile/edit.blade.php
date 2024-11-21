@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profil</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input untuk Nama -->
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <!-- Input untuk Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <!-- Input untuk Password -->
        <div class="form-group">
            <label for="password">Kata Sandi Baru:</label>
            <input type="password" name="password" class="form-control">
        </div>

        <!-- Input untuk Konfirmasi Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Profil</button>
    </form>
</div>
@endsection
