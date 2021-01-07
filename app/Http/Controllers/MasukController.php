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

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

// use App\Http\Controllers\Data\getID3;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_all = SuratMasuk::paginate(10);
        return view('masuk.index', compact('data_all'));
            
    }

    public function create()
    {
        return view('masuk.create');
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
            'asal_surat' => 'required|string|max:255',
        ]);
        
        if ($valid->fails())
        {
            Session::flash('warning', 'data gagal di simpan');
            return redirect()->back()
                ->withErrors($valid)
                ->withInput();
        }else{ 

            $data = new SuratMasuk();
            $data->tgl_surat = $request->input('tgl_surat');
            $data->tgl_diterima = $request->input('tgl_diterima');
            $data->perihal = $request->input('perihal');
            $data->sifat = $request->input('sifat');
            $data->asal_surat = $request->input('asal_surat');
            $data->save();

            Session::flash('success', 'data berhasil di simpan');
            return redirect('masuk');
        }
    }

    
    public function edit($id) {
        $data = SuratMasuk::where(['id'=>$id])->first();
        if(empty($data)){
            return redirect('masuk');
        }
        
        return view('masuk.edit', compact('data'));
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
            'asal_surat' => 'required|string|max:255',
        ]);

        if ($valid->fails())
        {
            return redirect()->back()
                ->withErrors($valid)
                ->withInput();
        }else{ 
            $data = SuratMasuk::find($id);
            if (empty($data)) {
                Session::flash('warning', 'data not found');
                return redirect()->back();
            }
            
            $data->tgl_surat = $request->input('tgl_surat');
            $data->tgl_diterima = $request->input('tgl_diterima');
            $data->perihal = $request->input('perihal');
            $data->sifat = $request->input('sifat');
            $data->asal_surat = $request->input('asal_surat');

            if($data->update()){
                Session::flash('success', 'data berhasil di simpan');
                return redirect('masuk');
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
        $data = SuratMasuk::where(['id' => $id])->first();

        if (empty($data)) {
            Session::flash('warning', 'data not found');
            return redirect()->back();
        }
        SuratKeluar::where(['id_surat_masuk' => $id])->delete();
        if ($data->delete()) {
            Session::flash('success', 'Delete Success');
        }else{
            Session::flash('warning', 'Eror Delete, data related');
        }
        return redirect()->back();
    }
}