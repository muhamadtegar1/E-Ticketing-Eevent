<!DOCTYPE html>
<html>
<head>
    <title>Unggah Gambar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <img src="{{ asset('storage/images/' . session('image')) }}" width="300">
    @endif
    <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Pilih Gambar</label>
            <input type="file" name="image" class="form-control" id="image">
            @error('image')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Unggah</button>
    </form>
</div>
</body>
</html>
