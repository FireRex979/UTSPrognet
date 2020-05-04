@extends('app')

@section('konten')
    {{-- @php
        dd($dosen->detail_pengajar);
    @endphp --}}
    <h1>Tambah Data Dosen</h1>
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
            <form class="forms-sample" action="/dosen/{{$dosen->id}}" method="POST">
                @csrf
                @method('PUT')
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama dosen</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama_dosen" value="{{$dosen->nama_dosen}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="emaildosen" value="{{$dosen->emaildosen}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nomor Telepon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nomor_telepon" value="{{$dosen->nomor_telepon}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="tgl_lahir" value="{{$dosen->tgl_lahir}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="alamat" value="{{$dosen->alamat}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Matakuliah Ajaran</label>
                <div class="col-sm-9">
                  <select name="matakuliah_id[]" id="matakuliah" multiple>
                      @foreach ($matakuliah as $matkul)
                          <option value="{{$matkul->id}}" @foreach ($dosen->detail_pengajar as $item)
                              @if($matkul->id == $item->id_matakuliah)
                                selected
                              @endif
                          @endforeach>{{$matkul->nama_matakuliah}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
            </form>
            <br>
            <a href="/dosen" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
          </div>
        </div>
      </div>
@endsection