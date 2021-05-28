@extends('layouts.app') @section('content')
<div class="container-fluid">
  <h1 class="mt-4">Input Fasilitas</h1>
  <div class="card mt-4 mb-4">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>Penambahan Fasilitas
      </div>
      <div class="card-body">
        <form method="POST" action="{{route(auth()->user()->level.'.updateRuang', $ruang)}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group" id="secTingkat">
            <label for="exampleFormControlSelect1">Tingkatan</label>
            <select name="tingkatan" class="form-control" id="tingkat">
              <option>-- Pilih Tingkatan--</option>
              <option value="Aliyah" @if($ruang->tingkatan == 'Aliyah') selected @endif>Aliyah</option>
              <option value="Tsanawiyah" @if($ruang->tingkatan == 'Tsanawiyah') selected @endif>Tsanawiyah</option>
              <option value="Ibtidayah" @if($ruang->tingkatan == 'Ibtidayah') selected @endif>Ibtidayah</option>
              <option value="Umum" @if($ruang->tingkatan == 'Umum') selected @endif>Umum</option>
            </select>
          </div>
          <div class="form-group" id="secAsrama">
            <label for="exampleFormControlInput2">Asrama</label>
            <select name="asrama" class="form-control" id="asrama">
              <option>-- Pilih Asrama--</option>
              <option value="Putra" @if($ruang->asrama == 'Putra') selected @endif>Putra</option>
              <option value="Putri" @if($ruang->asrama == 'Putri') selected @endif>Putri</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput2">Ruang</label>
            <input name="nama_ruang" type="text" class="form-control" id="exampleFormControlInput2" value="{{ $ruang->nama_ruang }}">
          </div>
          <button type="submit" class="btn btn-primary mb-2 float-right">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection @section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
  $(document).ready(function ($) {
    $("#tingkat").change(function () {
      if ($(this).val() == "Umum") {
        $("#secAsrama").hide();
      } else {
        $("#secAsrama").show();
      }
    });
  });
</script>
<script>
  $("#fasilitas").select2().trigger("change");
</script>
@endsection
