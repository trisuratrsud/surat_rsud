<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use Validator;
use Session;
use Image;
use Auth;

use App\Models\SuratKeluar;

// use App\Http\Controllers\Data\getID3;

class KeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_all = SuratKeluar::paginate(10);
        return view('keluar.index', compact('data_all'));
            
    }

    public function create()
    {
        return view('keluar.create');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'tujuan_surat' => 'required|string|max:255',
        ]);
        
        if ($valid->fails())
        {
            Session::flash('warning', 'data gagal di simpan');
            return redirect()->back()
                ->withErrors($valid)
                ->withInput();
        }else{ 

            $data = new SuratKeluar();
            $data->tgl_surat = $request->input('tgl_surat');
            $data->id_surat_masuk = $request->input('id_surat_masuk');
            $data->perihal = $request->input('perihal');
            $data->sifat = $request->input('sifat');
            $data->tujuan_surat = $request->input('tujuan_surat');
            $data->save();

            Session::flash('success', 'data berhasil di simpan');
            return redirect('keluar');
        }
    }

    
    public function edit($id) {
        $data = SuratKeluar::where(['id'=>$id])->first();
        if(empty($data)){
            return redirect('keluar');
        }
        
        return view('keluar.edit', compact('data'));
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
        $valid = Validator::make($request->all(), [
            'tujuan_surat' => 'required|string|max:255',
        ]);

        if ($valid->fails())
        {
            return redirect()->back()
                ->withErrors($valid)
                ->withInput();
        }else{ 
            $data = SuratKeluar::find($id);
            if (empty($data)) {
                Session::flash('warning', 'data not found');
                return redirect()->back();
            }
            
            $data->tgl_surat = $request->input('tgl_surat');
            $data->id_surat_masuk = $request->input('id_surat_masuk');
            $data->perihal = $request->input('perihal');
            $data->sifat = $request->input('sifat');
            $data->tujuan_surat = $request->input('tujuan_surat');

            if($data->update()){
                Session::flash('success', 'data berhasil di simpan');
                return redirect('keluar');
            }
            else{
                Session::flash('warning', 'data gagal update');
                $valid = "harap isian jangan kosong";
                return redirect()->back()
                    ->withErrors($valid)
                    ->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SuratKeluar::where(['id' => $id])->first();

        if (empty($data)) {
            Session::flash('warning', 'data not found');
            return redirect()->back();
        }
        
        if ($data->delete()) {
            Session::flash('success', 'Delete Success');
        }else{
            Session::flash('warning', 'Eror Delete, data related');
        }
        return redirect()->back();
    }
}