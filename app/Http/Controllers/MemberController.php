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
                ->join('transaksimember', 'member.member_id', '=', 'transaksimember.member_id')
                ->select('user.nama', 'member.member_id', 'member.status', 'member.active_date', 'member.end_date', 'transaksimember.payment_status', 'transaksimember.file')
                ->get();
        }
        else{
            $dataMember = DB::table('member')
                ->select('member.member_id', 'member.status', 'member.start_date', 'member.end_date', 'transaksimember.price', 'transaksimember.payment_status','transaksimember.lama_member', 'product.deskripsi')
                ->join('transaksimember', 'member.member_id', '=', 'transaksimember.member_id')
                ->join('product', 'transaksimember.product_id', '=', 'product.product_id')
                ->where('user_id', '=', Session::get('user_id'))
                ->where('product.product_id', '=', '2')
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
            'lama_member'=>'required',
        ],
        [
            'lama_member.required'=>'Lama Berlangganan tidak boleh kosong',
        ]);

        $queryInsertMember = DB::table('member')->insert([
            'user_id' => Session::get('user_id'),
            'status' => 'Non Aktif',
            'created_date' => Carbon::now(),
        ]);

        if ($queryInsertMember){
            $getProductPrice = DB::table('product')
                ->select('price')
                ->where('product_id', '=', '2')
                ->first();

            $price = (int)$getProductPrice->price;

            $getMemberID = DB::table('member')
                ->select('member_id')
                ->where('user_id', '=', Session::get('user_id'))
                ->first();

            $queryInsertTransaksi = DB::table('transaksimember')->insert([
                'member_id' => $getMemberID->member_id,
                'product_id' => '2',
                'price' => $price,
                'payment_status' => 'Pending',
                'lama_member' => $request->input('lama_member'),
                'created_date' => Carbon::now(),
                'is_verified' => '0',
            ]);
            if ($queryInsertTransaksi){
                return redirect('/member')->with('success', 'Daftar Berhasil');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadBuktiPembayaran(Request $request){

       if($request->file('buktiBayar')){
                $getMemberID = DB::table('member')
                   ->select('member_id')
                   ->where('user_id', '=', Session::get('user_id'))
                   ->first();

                   $fileName = time().$request->file('buktiBayar')->getClientOriginalName();
                $queryInsert = DB::table('transaksimember')
                   ->where('member_id', '=', $getMemberID->member_id)
                   ->where('is_verified', '=', '0')
                   ->update([
                       'file' => $fileName,
                       'payment_status' => 'Paid'
                       ]
                   );

           if ($queryInsert){
                    $request->file('buktiBayar')->move(public_path('uploads/bukti_bayar'), $fileName);
                    return redirect('/member')->with('success', 'Upload Berhasil');
                }

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
            ->select('user.nama', 'member.member_id', 'member.status', 'member.active_date', 'member.end_date')
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
//        dd($request->all());

        if ($request->input('status') == '1') {
            $current = Carbon::now();
            $lamaMember = DB::table('transaksimember')
                ->select('lama_member')
                ->where('member_id', '=', $id)
                ->first();
            $expires = $current->addMonth($lamaMember->lama_member);
            $queryUpdate = DB::table('member')->where('member_id', $id)
                ->update([
                    'status' => $request->input('status'),
                    'active_date' => Carbon::now(),
                    'end_Date' => $expires,

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
