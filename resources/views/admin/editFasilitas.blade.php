@extends('layouts.app') @section('content')
<div class="container-fluid">
  <h1 class="mt-4">Update Fasilitas</h1>
  <div class="card mt-4 mb-4">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>Update Fasilitas
      </div>
      <div class="card-body">
        <form method="POST" action="{{route(auth()->user()->level.'.updateFasilitas', $fasilitas)}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group" id="secTingkat">
            <label for="exampleFormControlSelect1">Tingkatan</label>
            <select name="tingkat" class="form-control" id="tingkat" required>
              <option value="">-- Pilih Tingkatan--</option>
              <option value="Aliyah">Aliyah</option>
              <option value="Tsanawiyah">Tsanawiyah</option>
              <option value="Ibtidayah">Ibtidayah</option>
              <option value="Umum">Umum</option>
            </select>
          </div>
          <div class="form-group" id="secAsrama">
            <label for="exampleFormControlInput2">Asrama</label>
            <select name="asrama" class="form-control" id="asrama" required>
              <option value="">-- Pilih Asrama--</option>
              <option value="Putra">Putra</option>
              <option value="Putri">Putri</option>
            </select>
          </div>
          <div class="form-group" id="ruangan">
            <label for="exampleFormControlInput2">Ruang</label>
            <select name="ruang" id="ruang" class="form-control" required>
              <option value="">--Select Ruangan--</option>
            </select>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label for="exampleFormControlInput2">Fasilitas</label>
              <input name="fasilitas" type="text" class="form-control" id="exampleFormControlInput2" value="{{ $fasilitas->nama_fasilitas }}" required>
              </div>
              <div class="col">
                <label for="exampleFormControlInput2">Jumlah</label>
                <input name="jumlah" type="number" class="form-control" id="exampleFormControlInput2" value="{{ $fasilitas->jumlah }}" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mb-2 float-right">
            Update
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
      $.ajax({
          type: "get",
          url:
            "/api/ruangan?tingkatan=" +
            $("#tingkat").val(),
          success: function (res) {
            $("#ruang").empty();
            $("#ruang").append("<option value=''>--Select Ruangan--</option>");

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
        $("#asrama").change(function () {
          $.ajax({
            type: "get",
            url:
              "/api/ruangan?tingkatan=" +
              $("#tingkat").val() +
              "&asrama=" +
              $("#asrama").val(),
            success: function (res) {
              $("#ruang").empty();
              $("#ruang").append("<option value=''>--Select Ruangan--</option>");

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
    });
  });
</script>
<script>
  $("#fasilitas").select2().trigger("change");
</script>
@endsection
