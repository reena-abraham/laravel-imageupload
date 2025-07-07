<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Carbon\Carbon;

class ImageController extends Controller
{
    public function index()
    {
        return view('upload_file');
    }

    public function upload(Request $request)
    {
         $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        $imageName = Carbon::now()->timestamp.'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        Image::create(['filename' => $imageName]);
        return response()->json(['success' => true, 'filePath' => $imageName]);
        // return response()->json('Image uploaded successfully');
    }
}
