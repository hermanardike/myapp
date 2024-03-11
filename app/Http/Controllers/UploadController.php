<?php

namespace App\Http\Controllers;

use App\Models\Temporary;
use App\Models\Uploadfile;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use const http\Client\Curl\AUTH_ANY;


class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $upload = Uploadfile::where('id_user', '=', Auth::user()->id)->paginate('5');
        return  view('upload.index',compact('upload'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('upload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'upload_name' => 'required',
            'image' =>'required|string',
        ]);


        //Untuk Method Upload Imagenya
//        $request->file('image')->store('public/' . Auth::user()->id);

        //ambil details temporary file berdasarkan foldername
        $tmp =  Temporary::where('foldername', $request->image)->first();

        // Resize Image Using Interevention
        $img= Image::make(storage_path('app/tmp/'. $tmp->foldername . '/' .  $tmp->filename))
        ->resize(50, 50);

        // Save image to thumbnail folder
        Storage::disk('public')
            ->put(Auth::user()->id . '/thumbnails/' . $tmp->filename, $img->encode());

        // COpy file original from tmp to public
        Storage::copy('tmp/' . $tmp->foldername . '/' . $tmp->filename, 'public/' .  Auth::user()->id . '/' . $tmp->filename);

        // Untuk Method Create instert into Database
        Uploadfile::create([
                 'upload_name' => $request->upload_name,
                 'upload_path' => $tmp->filename,
                 'id_user' => Auth::user()->id,
             ]);

        // Delete temporary file
        Storage::deleteDirectory('tmp/' . $tmp->foldername);
        $tmp->delete();

        return redirect()->route('upload.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $upload = Uploadfile::find($id);
        return view('upload.show',compact('upload'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $upload = Uploadfile::find($id);
        return view('upload.edit',compact('upload'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'upload_name' => 'required',
            'image' =>'required|string',
        ]);
        // Query data id database
        $upload = Uploadfile::find($id);

        // Mengambil data old upload  untuk di hapus
        $oldImage = $upload->upload_path;

//        // Method Mengambil data Imagenya
//        $request->file('image')->store('public/' . Auth::user()->id);

        //ambil details temporary file berdasarkan foldername
        $tmp =  Temporary::where('foldername', $request->image)->first();

        // Resize Image Using Interevention
        $img= Image::make(storage_path('app/tmp/'. $tmp->foldername . '/' .  $tmp->filename))
            ->resize(50, 50);

        // Save image to thumbnail folder
        Storage::disk('public')
            ->put(Auth::user()->id . '/thumbnails/' . $tmp->filename, $img->encode());

        // COpy file original from tmp to public
        Storage::copy('tmp/' . $tmp->foldername . '/' . $tmp->filename, 'public/' .  Auth::user()->id . '/' . $tmp->filename);

        // method untuk update data insert into database
        $upload->upload_name = $request->upload_name;
        $upload->upload_path = $tmp->filename;
        $upload->id_user =  Auth::user()->id;
        $upload->save();
        // Metode untuk menghapus data image yang lama
        if ($oldImage != 'default.jpg'){
            Storage::disk('public')->delete(Auth::user()->id . '/' .  $oldImage);
            Storage::disk('public')->delete(Auth::user()->id . '/thumbnails/' .  $oldImage);
        }
        // Delete temporary file
        Storage::deleteDirectory('tmp/' . $tmp->foldername);
        $tmp->delete();
        return redirect()->route('upload.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $upload =  Uploadfile::find($id);
       if ($upload->upload_path != 'default.jpg')
       {
           Storage::disk('public')->delete(Auth::user()->id .'/'. $upload->upload_path);
           Storage::disk('public')->delete(Auth::user()->id . '/thumbnails/'. $upload->upload_path);
       }
       $upload->delete($id);
       return redirect()->route('upload.index');
    }
}
