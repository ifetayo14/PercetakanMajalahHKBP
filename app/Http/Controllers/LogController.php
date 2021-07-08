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

            if ($data->role_id == '1'){
                return redirect('dashAdmin');
            }
            elseif ($data->role_id == '2'){
                return redirect('dashJemaat');
            }
            elseif ($data->role_id == '5'){
                return redirect('dashPendeta');
            }
            elseif ($data->role_id == '3'){
                return redirect('dashSekjen');
            }
            else{
                return redirect('dashTimMajalah');
            }
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
