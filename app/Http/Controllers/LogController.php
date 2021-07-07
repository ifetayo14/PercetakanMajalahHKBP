<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{
    public function loginProcess(Request $request){
        $data = DB::table('users')
            ->where('username', $request->username)
            ->where('password', $request->password)->first();

        var_dump($data);
        if ($data){
            $request->session()->put('username', $data->Username);
            $request->session()->put('role', $data->Role);

            if ($data->Role == '1'){
                return redirect('dashAdmin');
            }
            elseif ($data->Role == '2'){
                return redirect('dashJemaat');
            }
            elseif ($data->Role == '3'){
                return redirect('dashPendeta');
            }
            elseif ($data->Role == '4'){
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
