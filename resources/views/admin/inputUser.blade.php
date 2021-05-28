@extends('layouts.app') @section('content')
<div class="container-fluid">
  <h1 class="mt-4">Input User</h1>
  <div class="card mt-4 mb-4">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>Penambahan User
      </div>
      <div class="card-body">
        <form method="POST" action="{{route('storeUser')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlInput2">Nama</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput2" value="{{ old('name') }}" placeholder="Nama Pengguna" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput2">Email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput2" value="{{ old('email') }}" placeholder="Email Pengguna" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput2">Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="exampleFormControlInput2" placeholder="Password Pengguna" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
          <div class="form-group">
            <label for="exampleFormControlInput2">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" id="exampleFormControlInput2" placeholder="Ketik Password Ulang" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput2">Jabatan</label>
            <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" required>
              <option value="">-- Pilih Jabatan--</option>
              <option value="Kepala Unit">Kepala Unit</option>
              <option value="Pimpinan Dayah">Pimpinan Dayah</option>
              <option value="Pengasuh Yayasan">Pengasuh Yayasan</option>
              <option value="Kepala Sekolah">Kepala Sekolah</option>
              <option value="Kepala Asrama">Kepala Asrama</option>
            </select>
            @error('jabatan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary mb-2 float-right">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
