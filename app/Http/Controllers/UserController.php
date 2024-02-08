<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{


    public function index(Request $request)
    {
        if (Gate::denies('index-user')) {
            abort(403,'Anda Tidak Memilki Akses');
        }
        $users = DB::table('users')
            ->when($request->input('search'), function($query, $search) {
                $query->where('name', 'like',"%" . $search . "%")
                    ->orWhere('email', 'like',"%" . $search . "%");
            })->paginate(5);
        return view('user.index',compact('users'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
