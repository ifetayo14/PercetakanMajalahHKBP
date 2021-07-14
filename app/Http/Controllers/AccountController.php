<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAkun = DB::table('user')->get()->where('role_id', '!=', '1');
        return view('akun.index', compact('dataAkun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getID = DB::table('user')->select('user_id')->max('user_id');
        $newID = (int)$getID + 1;

        $request->validate([
            'username'=>'required|alpha_num|unique:App\Models\User,Username',
            'password'=>'required|min:6',
            'alamat'=>'required',
            'nama'=>'required',
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
                'nama.required'=>'Nama tidak boleh kosong',
                'email.unique'=>'Email tidak tersedia, silahkan coba username lainnya',
                'email.required'=>'Email tidak boleh kosong',
                'role.required'=>'Role tidak boleh kosong',
            ]);
        $queryInsert = DB::table('user')->insert([
            'user_id' => $newID,
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'status' => '1',
            'role_id' => $request->input('role'),
            'created_by' => Session::get('username'),
            'created_date' => Carbon::now(),
            'update_by' => Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            return redirect('/akun')->with('success', 'Daftar Akun Berhasil');
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
        $data = DB::table('user')->where('user_id', $id)->first();
        $dataAkun = [
            'dataAkun' => $data
        ];

        return view('akun.edit', $dataAkun);
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
            'username'=>'required|alpha_num',
            'alamat'=>'required',
            'nama'=>'required',
            'email'=>'required',
            'role'=>'required',
            'status'=>'required',
        ],
        [
            'username.required'=>'Username tidak boleh kosong',
            'username.alpha_num'=>'Username hanya dapat terdiri dari huruf dan angka',
            'username.unique'=>'Username tidak tersedia, silahkan coba username lainnya',
            'alamat.required'=>'Alamat tidak boleh kosong',
            'nama.required'=>'Nama tidak boleh kosong',
            'email.unique'=>'Email tidak tersedia, silahkan coba username lainnya',
            'email.required'=>'Email tidak boleh kosong',
            'role.required'=>'Role tidak boleh kosong',
            'status.required'=>'Status tidak boleh kosong',
        ]);

        $queryUpdate = DB::table('user')->where('user_id', $request->input('id'))
            ->update([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'status' => $request->input('status'),
                'role_id' => $request->input('role'),
                'update_by' => Session::get('username'),
                'updated_date' => Carbon::now(),
            ]);

        return redirect('akun')->with('success', 'Data Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = DB::table('user')->where('user_id', $id)->delete();
        return redirect('akun')->with('success', 'Data Dihapus');
    }
}
