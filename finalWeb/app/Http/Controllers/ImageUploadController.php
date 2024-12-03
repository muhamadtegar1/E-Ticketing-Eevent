<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        // Simpan gambar di storage/app/public/images
        $request->image->storeAs('public/images', $imageName);

        return back()->with('success', 'Gambar berhasil diunggah.')->with('image', $imageName);
    }
}
