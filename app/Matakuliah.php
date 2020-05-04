<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matakuliah extends Model
{
    use SoftDeletes;

    protected $date = ['deleted_at'];

    public function detail_pengajar(){
        return $this->hasMany('App\Detail_Pengajar', 'id_matakuliah', 'id');
    }

    public function dosen(){
        return $this->belongsToMany('App\Dosen', 'detail_pengajars', 'id_matakuliah', 'id_dosen')->withPivot('id');
    }
}
