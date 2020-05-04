<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Pengajar extends Model
{
    protected $table = 'detail_pengajars';

    public function dosen(){
        return $this->belongsTo('App\Dosen', 'id_dosen', 'id');
    }

    public function matakuliah(){
        return $this->belongsTo('App\Matakuliah', 'id_matakuliah', 'id');
    }
}
