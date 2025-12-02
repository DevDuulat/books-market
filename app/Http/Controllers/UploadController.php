<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function storeSingle(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:4096',
            'directory' => 'required|string'
        ]);

        $path = $request->file('file')->store($request->directory, 'public');

        return response()->json([
            'path' => $path,
            'url' => asset('storage/'.$path)
        ]);
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'file.*' => 'required|image|max:4096',
            'directory' => 'required|string'
        ]);

        $paths = [];

        foreach ($request->file('file') as $file) {
            $paths[] = $file->store($request->directory, 'public');
        }

        return response()->json([
            'paths' => $paths
        ]);
    }
}
