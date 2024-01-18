<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Desert;
use Illuminate\Http\Request;
use Validator;
use DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi::leftJoin('deserts','transaksis.id_desert','=','deserts.id')->get(['title','harga','qty','total']);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'id_desert'=>'required|numeric',
            'qty'=>'required|numeric',
        ]);

        if($validate->fails()){
            return $validate->errors();
        }

        try {
            DB::beginTransaction();

            $desert = Desert::find($request->id_desert);
            $total = $request->qty * $desert->harga;

            if($request->qty > $desert->stock){
                return 'Stock Desert Tidak Cukup';
            }

            Transaksi::create([
                'id_desert'=>$request->id_desert,
                'qty'=>$request->qty,
                'total'=>$total,
            ]);

            $desert->update([
                'stock'=>$desert->stock - $request->qty
            ]);

            DB::commit();
            return 'Data Transaksi Berhasil Ditambahkan';

        } catch (\Throwable $e) {

            DB::rollback();
            return 'Data Transaksi '.$e->getMessage();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
