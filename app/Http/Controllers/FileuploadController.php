<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileuploadController extends Controller
{

    public function create()
    {
        return view('fileupload.create');
    }
    public function store(Request $request)
    {
//            $path =  $request->file('image')->store('public');
//        $path =  Storage::putFile('public', $request->file('image'));
//        $deviname = 'Dell-R720';
//        $extension = $request->file('image')->extension();
//        $name = 'device-name';
//        $path = $request->file('image')->storeAs('public', $name . '.' . $extension);
//        $path = $request->file('image')->store('surat_tugas/newDevice');

        $path = Storage::putFile('surat_tugas/newdevice', $request->file('image'));
         ddd($path);
    }

}


//        //UPload Mengarah ke Defualt Storage
//       Storage::put('upload.txt','file upload default disk2');
//       // upload mengarah ke Public Storage
//        Storage::disk('public')->put('public.txt','file upload public');
//        // Upload Mengarah ke driver dan storage surat tugas otomatis buat folder surat tugas
//        Storage::disk('surat_tugas')->put('surat-tugas.txt','file upload surat-tugas');
//        // Download
//        return Storage::download('upload.txt');
