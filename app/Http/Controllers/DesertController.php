<?php

namespace App\Http\Controllers;

use App\Models\Desert;
use Illuminate\Http\Request;
use DB;
use Validator;
class DesertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Desert::get();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Desert $desert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desert $desert)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(),[
            'stock'=>'required|numeric'
        ]);

        if($validate->fails()){
            return $validate->errors();
        }

        try {
            DB::beginTransaction();
                $desert = Desert::find($id);

                $desert->update([
                    'stock'=>$desert->stock+$request->stock
                ]);
            DB::commit();
            return 'Data Stock Berhasil Ditambahkan';
        } catch (\Throwable $e) {

            DB::rollback();
            return 'Data Stock Gagal Ditambahkan';

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desert $desert)
    {
        //
    }
}
