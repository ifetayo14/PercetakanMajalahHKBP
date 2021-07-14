<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{
    public function loginProcess(Request $request){
        $data = DB::table('user')
            ->where('username', $request->username)
            ->where('password', $request->password)->first();

        var_dump($data);
        if ($data){
            $request->session()->put('username', $data->username);
            $request->session()->put('role', $data->role_id);
            $request->session()->put('nama', $data->nama);
            $request->session()->put('user_id', $data->user_id);

            return redirect('index');
        }

        return redirect('/')->with('error', 'Username atau Password Anda Salah');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        session_unset();
        return redirect('/');
    }
}
