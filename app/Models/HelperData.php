<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelperData extends Model
{
    //
	public static function sifat_surat(){
        return array(
            1=>'Biasa',
            2=>'Rahasia',
            3=>'Sangat Rahasia',
            4=>'Segera',
        );
    }
}