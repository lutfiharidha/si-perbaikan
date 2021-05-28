@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Input Kerusakan</h1>
    <div class="card mt-4 mb-4">
    <div class="card ">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Ajukan Perbaikan</div>
      <div class="card-body">
        <form method="POST" action="{{route(auth()->user()->level.'.storeKerusakan')}}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <div class="col"  id="secTingkat">
                <label for="exampleFormControlSelect1">Tingkatan</label>
                <select name="tingkat" class="form-control" id="tingkat">
                  <option>-- Pilih Tingkatan--</option>
                  <option value="Aliyah">Aliyah</option>
                  <option value="Tsanawiyah">Tsanawiyah</option>
                  <option value="Ibtidayah">Ibtidayah</option>
                  <option value="Umum">Umum</option>
                </select>
              </div>
              <div class="col" id="secAsrama">
                <label for="exampleFormControlInput2">Asrama</label>
                <select name="asrama" class="form-control" id="asrama">
                  <option>-- Pilih Asrama--</option>
                  <option value="Putra">Putra</option>
                  <option value="Putri">Putri</option>
                </select>
              </div>
              <div class="col" id="ruangan">
                <label for="exampleFormControlInput2">Ruang</label>
                <select name="ruang" id="ruang" class="form-control">
                  <option>--Select Ruangan--</option>
                </select>
              </div>
              <div class="col">
                <label for="exampleFormControlInput2">Fasilitas</label>
                <select name="fasilitas" id="fasilitas" class="form-control">
                  <option>--Select Fasilitas--</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col">
                <label for="exampleFormControlInput2">Total</label>
                <input name="total" type="number" class="form-control" id="exampleFormControlInput2" placeholder="Jumlah Kerusakan">
              </div>
              <div class="col">
                <label for="exampleFormControlInput2">Tingkat Kerusakan</label>
                <select name="tingkatan" class="form-control">
                  <option>-- Pilih Tingkatan--</option>
                  <option value="ringan">Ringan</option>
                  <option value="sedang">Sedang</option>
                  <option value="berat">Berat</option>
                  <option value="total">Total</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Foto</label>
                <input name="foto" type="file" class="form-control-file" id="exampleFormControlFile1">
              </div>
              <button type="submit" class="btn btn-primary mb-2 float-right">Ajukan</button>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
  $(document).ready(function ($) {

    // Mencari Ruang Berdasarkan ASRAMA
    $("#tingkat").change(function () {
      $("#ruang").empty();
      $("#ruang").append("<option>--Select Ruangan--</option>");
      $("#fasilitas").empty();
      $("#fasilitas").append("<option>--Select Fasilitas--</option>");
      $.ajax({
          type: "get",
          url:
            "/api/ruangan?tingkatan=" +
            $("#tingkat").val(),
          success: function (res) {
            if (res) {
              $.each(res, function (key, value) {
                $("#ruang").append(
                  $("<option/>", {
                    value: value.id,
                      text: value.nama_ruang,
                  })
                );
              });
            }
          },
        });
      if ($(this).val() == "Umum") {
        $("#secAsrama").hide();
      } else {
        $("#secAsrama").show();

        // Mencari Ruangan Umum
        $("#asrama").change(function () {
          $("#fasilitas").empty();
          $("#fasilitas").append("<option>--Select Fasilitas--</option>");
          $.ajax({
            type: "get",
            url:
              "/api/ruangan?tingkatan=" +
              $("#tingkat").val() +
              "&asrama=" +
              $("#asrama").val(),
            success: function (res) {
              $("#ruang").empty();
              $("#ruang").append("<option>--Select Ruangan--</option>");

              if (res) {
                $.each(res, function (key, value) {
                  $("#ruang").append(
                    $("<option/>", {
                      value: value.id,
                      text: value.nama_ruang,
                    })
                  );
                });
              }
            },
          });
        });
      }
      // Mencari Fasilitas RUANGAN
        $("#ruangan").change(function () {
        $.ajax({
          type: "get",
          url:
            "/api/ruangan?ruang=" +
            $("#ruang").val(),
          success: function (res) {
            $("#fasilitas").empty();
            $("#fasilitas").append("<option>--Select Fasilitas--</option>");

            if (res) {
              $.each(res, function (key, value) {
                $("#fasilitas").append(
                  $("<option/>", {
                    value: value.id,
                      text: value.nama_fasilitas,
                  })
                );
              });
            }
          },
        });
      });
    });
  });
</script>
@endsection