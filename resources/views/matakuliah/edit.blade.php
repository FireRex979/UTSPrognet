@extends('app')

@section('konten')
    <h1>Tambah Data Matakuliah</h1>
    <br>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="forms-sample" action="/matakuliah/{{$matakuliah->id}}" method="POST">
                @csrf
                @method('PUT')
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Matakuliah</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama_matakuliah" value="{{$matakuliah->nama_matakuliah}}">
                </div>
              </div>
              <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
            </form>
            <br>
            <a href="/matakuliah" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card" id="gambar">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="/admin/produk/store" method="POST">
                @csrf
                {{-- @php
                    dd($matakuliah->dosen)
                @endphp --}}
                <h4>Data Dosen Pengampu</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tr>     
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Opsi</th>
                        </tr>
                        @if ($matakuliah->dosen->count())
                        @foreach ($matakuliah->dosen as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama_dosen}}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure?')" href="/dosen/{{$item->id}}"> Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td>Belum ada dosen yang mengampu</td>
                        @endif          
                        </table>
                    </div>
            </form>
            <br>
            <a href="/matakuliah" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Back</button></a>
          </div>
        </div>
      </div>

@endsection