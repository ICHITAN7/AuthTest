<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show($urlImage)
    {
        $path = public_path('images/'.$urlImage);
        if (!Storage::exists($path)) {
            abort(404);
        }
        $file=Storage::get($path);
        $type=Storage::mimeType($path);
        return response()->json([
            'message' => 'successfully',
            'user'=>$type,
    ], 200);
    }
}
