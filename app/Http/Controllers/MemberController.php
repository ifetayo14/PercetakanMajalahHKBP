<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('role') == '1' || Session::get('role') == '4'){
            $dataMember = DB::table('member')
                ->join('user', 'member.user_id', '=', 'user.user_id')
                ->select('user.nama', 'member.member_id', 'member.status', 'member.start_date', 'member.end_date')
                ->get();
        }
        else{
            $dataMember = DB::table('member')
                ->where('user_id', '=', Session::get('user_id'))
                ->first();
        }

//        dd($dataMember);
        return view('member.index', compact('dataMember'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.add');
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
            'start_date'=>'required',
            'end_date'=>'required',
        ],
        [
            'start_date.required'=>'Tanggal Mulai Berlangganan tidak boleh kosong',
            'end_date.required'=>'Tanggal Berakhir Berlangganan tidak boleh kosong',
        ]);

        $queryInsert = DB::table('member')->insert([
            'user_id' => Session::get('user_id'),
            'status' => '0',
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'created_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            return redirect('/member');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('member')
            ->join('user', 'member.user_id', '=', 'user.user_id')
            ->select('user.nama', 'member.member_id', 'member.status', 'member.start_date', 'member.end_date')
            ->where('member.member_id', '=', $id)
            ->first();
        $dataMember = [
            'dataMember' => $data
        ];
        return view('member.edit', $dataMember);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date'=>'required',
            'end_date'=>'required',
        ],
        [
            'start_date.required'=>'Tanggal Mulai Berlangganan tidak boleh kosong',
            'end_date.required'=>'Tanggal Berakhir Berlangganan tidak boleh kosong',
        ]);

//        dd($request->all());

        if ($request->input('status') == '1') {
            $queryUpdate = DB::table('member')->where('member_id', $id)
                ->update([
                    'status' => $request->input('status'),
                    'active_date' => Carbon::now(),
                ]);
        }
        else{
            $queryUpdate = DB::table('member')->where('member_id', $id)
                ->update([
                    'status' => $request->input('status'),
                ]);
        }

        return redirect('member')->with('success', 'Data Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
