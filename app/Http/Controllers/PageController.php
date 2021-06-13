<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function toAdmin(){
        return view('admin.index');
    }

    public function toJemaat(){
        return view('jemaat.index');
    }

    public function toPendeta(){
        return view('pendeta.index');
    }

    public function toSekjen(){
        return view('sekjen.index');
    }

    public function toTimMajalah(){
        return view('timMajalah.index');
    }
}
