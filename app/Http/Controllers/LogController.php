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

        if ($data){
            $request->session()->put('username', $data->username);
            $request->session()->put('role', $data->role);
            $request->session()->put('name', $data->name);

            if ($data->role == 'admin'){
                return redirect('dashAdmin');
            }
            elseif ($data->role == 'jemaat'){
                return redirect('dashJemaat');
            }
            elseif ($data->role == 'pendeta'){
                return redirect('dashPendeta');
            }
            elseif ($data->role == 'sekjen'){
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
