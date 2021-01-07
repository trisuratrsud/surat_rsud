<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    //
    protected $table = 'surat_masuks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl_surat',
        'tgl_diterima',
        'perihal',
        'sifat',
        'asal_surat',
    ];

    public function keluar()
    {
        return $this->hasMany('App\Models\SuratKeluar', 'id_surat_masuk');
    }

    public function sifat_text(){
        $sifat = HelperData::sifat_surat();
        return isset($sifat[$this->sifat])?$sifat[$this->sifat]:'';
    }

    public static function list_surat(){
        $data = SuratMasuk::all();
        $list = array();
        foreach ($data as $item){
            $list[$item->id] = $item->perihal;
        }
        return $list;
    }
    
}
