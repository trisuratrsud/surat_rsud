<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    //
     protected $table = 'surat_keluars';
    protected $primaryKey = 'id';
    protected $fillable = [
    	'id_surat_masuk',
        'tgl_surat',
        'perihal',
        'sifat',
        'tujuan_surat',
    ];

    public function sifat_text(){
        $sifat = HelperData::sifat_surat();
        return isset($sifat[$this->sifat])?$sifat[$this->sifat]:'';
    }

    public function masuk() {
        return $this->belongsTo('App\Models\SuratMasuk', 'id_surat_masuk', 'id');
    }
}
