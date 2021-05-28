@extends('layouts.app') @section('content')
<div class="container-fluid">
  <h1 class="mt-4">Input Fasilitas</h1>
  <div class="card mt-4 mb-4">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>Penambahan Fasilitas
      </div>
      <div class="card-body">
        <form method="POST" action="{{route(auth()->user()->level.'.storeRuang')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group" id="secTingkat">
            <label for="exampleFormControlSelect1">Tingkatan</label>
            <select name="tingkatan" class="form-control" id="tingkat">
              <option>-- Pilih Tingkatan--</option>
              <option value="Aliyah">Aliyah</option>
              <option value="Tsanawiyah">Tsanawiyah</option>
              <option value="Ibtidayah">Ibtidayah</option>
              <option value="Umum">Umum</option>
            </select>
          </div>
          <div class="form-group" id="secAsrama">
            <label for="exampleFormControlInput2">Asrama</label>
            <select name="asrama" class="form-control" id="asrama">
              <option>-- Pilih Asrama--</option>
              <option value="Putra">Putra</option>
              <option value="Putri">Putri</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput2">Ruang</label>
            <input name="nama_ruang" type="text" class="form-control" id="exampleFormControlInput2" placeholder="Nama Ruangan">
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
