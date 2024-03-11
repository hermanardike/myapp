<?php

namespace App\Http\Controllers;

use App\Models\Temporary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileponController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        // Membuat Unique Name
        $folderName = uniqid() . '-' . Auth::user()->id . '-' . now()->timestamp;
        // Upload Filenya ke TMP Folder
        $request->file('image')->store('tmp/' . $folderName);

        //simpan ke temporary table
        Temporary::create([
            'foldername' => $folderName,
            'filename' => $request->file('image')->hashName(),
        ]);

        return $folderName;
    }

    public function destroy(Request $request)
    {
        Storage::deleteDirectory('tmp/' . $request->getContent());
        Temporary::where('foldername', $request->getContent())->delete();
        return '';
    }
}
