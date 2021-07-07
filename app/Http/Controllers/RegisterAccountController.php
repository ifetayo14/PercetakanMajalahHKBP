<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formRegister');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getID = DB::table('users')->select('User_Id')->max('User_id');
        $newID = (int)$getID + 1;
        if ($request->input('role') == 'jemaat'){
            $role = 2;
        }
        elseif ($request->input('role') == 'pendeta'){
            $role = 3;
        }
        $request->validate([
            'username'=>'required|alpha_num|unique:App\Models\User,Username',
            'password'=>'required|min:6',
            'alamat'=>'required',
            'email'=>'required|unique:App\Models\User,Email',
            'role'=>'required',
        ],
        [
            'username.required'=>'Username tidak boleh kosong',
            'username.alpha_num'=>'Username hanya dapat terdiri dari huruf dan angka',
            'username.unique'=>'Username tidak tersedia, silahkan coba username lainnya',
            'password.required'=>'Password tidak boleh kosong',
            'password.min'=>'Panjang karakter password tidak dapat kurang dari 6 karakter',
            'alamat.required'=>'Alamat tidak boleh kosong',
            'email.unique'=>'Email tidak tersedia, silahkan coba username lainnya',
            'email.required'=>'Email tidak boleh kosong',
            'role.required'=>'Role tidak boleh kosong',
        ]);
        $queryInsert = DB::table('users')->insert([
            'User_Id' => $newID,
            'Username' => $request->input('username'),
            'Alamat' => $request->input('alamat'),
            'Email' => $request->input('email'),
            'Password' => $request->input('password'),
            'Status' => 'Aktif',
            'Role' => $role,
            'Created_By' => $request->input('username'),
        ]);

        if ($queryInsert){
            return redirect('/')->with('success', 'Daftar Akun Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
