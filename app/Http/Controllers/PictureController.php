<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PictureController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pictures.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'nullable|string',       // Optional title for all pictures
            'description' => 'nullable|string' // Optional description
        ]);

        $uploadedPictures = [];

        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $path = $picture->store('public/pictures');
                $uploadedPictures[] = [
                    'user_id' => Auth::id(),
                    'path' => Storage::url($path),
                    'filename' => $picture->getClientOriginalName(),
                    'title' => $request->title,    
                    'description' => $request->description,
                    'mime_type' => $picture->getClientMimeType(),
                    'size' => $picture->getSize(),
                ];
            }
        }

        Auth::user()->pictures()->createMany($uploadedPictures);

        return response()->json([
            'message' => 'Pictures uploaded successfully',
            'pictures' => $uploadedPictures
        ], 201);
    }

    // In PictureController
    // public function index()
    // {
    //     return Auth::user()->pictures;
    // }

    public function destroy(Picture $picture)
    {
        // Verify the picture belongs to the authenticated user
        if ($picture->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized: You can only delete your own pictures'
            ], 403);
        }

        $filePath = 'private/public/pictures/' . basename($picture->path);

        // Delete using your custom disk (or default)
        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }

        // Delete record from database
        $picture->delete();

        return response()->json([
            'message' => 'Picture deleted successfully'
        ], 200);
    }
}
