@extends('app')

@section('konten')
    <h1>Manipulasi Data Dosen</h1>
    {{-- @php
        dd($dosen);
    @endphp --}}
    <br>
    <a href="/dosen/create"> + Tambah Data Dosen</a>
        
        <br/>
        <br/>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <tr>  
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Tanggal Lahir</th>
                        <th>Matakuliah Ajaran</th>
                    </tr>
                    @if ($dosen->count())
                        @foreach ($dosen as $ds)
                            <tr>
                                {{-- {{dd($pegawai)}} --}}
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ds->nama_dosen}}</td>
                                <td>{{$ds->emaildosen}}</td>
                                <td>{{$ds->nomor_telepon}}</td>
                                <td>{{$ds->tgl_lahir}}</td>
                                <td>
                                    @foreach ($ds->matakuliah as $item)
                                        @if ($loop->iteration == $ds->matakuliah->count())
                                            {{$item->nama_matakuliah}}
                                        @else
                                            {{$item->nama_matakuliah}},
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="/dosen/{{$ds->id}}/edit"><button class="btn btn-warning sm-2">Edit</button></a>
                                        <form action="/dosen/{{$ds->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger sm-2" onclick="return confirm('Are you sure?')">Hapus</button>
                                        </form>
                                    </div>                               
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>Belum ada data dosen!</td>
                    @endif          
                    </table>
                </div>
            </div>
    </div>
@endsection