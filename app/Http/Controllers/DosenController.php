<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Matakuliah;
use App\Detail_Pengajar as dp;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::with('matakuliah')->get();

        return view('dosen.dosen', ['dosen' => $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matakuliah = Matakuliah::all();

        return view('dosen.tambah', ['matakuliah' => $matakuliah]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'alpha' => ':attribute tidak boleh berisikan angka',
            'email' => ':attribute harus dimasukkan dengan benar',

        ];

        $this->validate($request,[
            'nama_dosen' => 'required',
            'emaildosen' => 'required|email',
            'nomor_telepon' => 'required|numeric',
            'tgl_lahir' => 'required|date|before:1995-12-31',
            'alamat' => 'required',
        ],$messages);

        $dosen = new Dosen;

        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->emaildosen = $request->emaildosen;
        $dosen->nomor_telepon = $request->nomor_telepon;
        $dosen->tgl_lahir = $request->tgl_lahir;
        $dosen->alamat = $request->alamat;
        $dosen->save();

       

        foreach($request->matakuliah_id as $matkul){
            $dtl_peng = new dp;
            $dtl_peng->id_dosen = $dosen->id;
            $dtl_peng->id_matakuliah = $matkul;
            $dtl_peng->save();
        }

        return redirect('/dosen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        $matakuliah = Matakuliah::all();
        return view('dosen.show', ['dosen' => $dosen, 'matakuliah' => $matakuliah]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        $matakuliah = Matakuliah::all();
        return view('dosen.edit',['dosen'=>$dosen, 'matakuliah' => $matakuliah]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->emaildosen = $request->emaildosen;
        $dosen->nomor_telepon = $request->nomor_telepon;
        $dosen->tgl_lahir = $request->tgl_lahir;
        $dosen->alamat = $request->alamat;
        $dosen->save();
        
        // dd($request->matakuliah_id);

        if(!$dosen->detail_pengajar->count()){
            foreach($request->matakuliah_id as $matkul){ 
                $new_dp = new dp;
                $new_dp->id_dosen = $dosen->id;
                $new_dp->id_matakuliah = $matkul;
                $new_dp->save();
            }
        }elseif(is_null($request->matakuliah_id)){
            foreach($dosen->detail_pengajar as $item){
                $item->delete();
            }
        }else{
            // dd($dosen->detail_pengajar);
            foreach($request->matakuliah_id as $matkul){
                $counter = 0;
                foreach($dosen->detail_pengajar as $item){
                    if($matkul == $item->id_matakuliah){
                        $counter++;
                    } 
                }
                if($counter == 0){
                    $new_dp = new dp;
                    $new_dp->id_dosen = $dosen->id;
                    $new_dp->id_matakuliah = $matkul;
                    $new_dp->save();
                }
            }

            $kecuali = Matakuliah::all()->whereNotIn('id',$request->matakuliah_id);
            
            foreach($kecuali as $item){
                
                foreach($dosen->detail_pengajar as $dp){
                    if($dp->id_matakuliah == $item->id){
                        $dp->delete();
                    }
                }
            }
        }
        

        return redirect('/dosen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect('/dosen');
    }
}
