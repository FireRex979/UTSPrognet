@extends('app')

@section('konten')
    <h1>Manipulasi Data Matakuliah</h1>
    {{-- @php
        dd($matakuliah);
    @endphp --}}
    <br>
    <a href="/matakuliah/create"> + Tambah Data Matakuliah</a>
        
        <br/>
        <br/>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <tr>  
                        <th>No</th>
                        <th>Nama Matakuliah</th>
                        <th>Opsi</th>
                    </tr>
                    @if ($matakuliah->count())
                        @foreach ($matakuliah as $ds)
                            <tr>
                                {{-- {{dd($pegawai)}} --}}
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ds->nama_matakuliah}}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="/matakuliah/{{$ds->id}}/edit"><button class="btn btn-warning sm-2">Edit</button></a>
                                        <form action="/matakuliah/{{$ds->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger sm-2" onclick="return confirm('Are you sure?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>Belum ada data matakuliah!</td>
                    @endif          
                    </table>
                </div>
            </div>
    </div>
@endsection