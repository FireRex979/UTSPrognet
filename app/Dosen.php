<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use SoftDeletes;

    protected $date = ['deleted_at'];
    
    public function detail_pengajar(){
        return $this->hasMany('App\Detail_Pengajar', 'id_dosen', 'id');
    }

    public function matakuliah(){
        return $this->belongsToMany('App\Matakuliah', 'detail_pengajars', 'id_dosen', 'id_matakuliah')->withPivot('id');
    }
}
