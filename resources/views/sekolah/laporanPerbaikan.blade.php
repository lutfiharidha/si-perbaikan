@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Perbaikan</h1>
    <div class="card mt-4 mb-4">
    <div class="card ">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Laporan Perbaikan
            <a href="#" id="print" class="float-right">PRINT</a>
        </div>
      <div class="card-body">
        <form method="POST">
            @csrf
            <div class="form-group row">
              <div class="col"  id="secTingkat">
                <label for="exampleFormControlSelect1">Fasilitas</label>
                <select name="tingkat" class="form-control" id="fasilitas">
                  <option>-- Pilih Fasilitas--</option>
                  @foreach($fasilitasi as $fasilitas)
                    <option value="{{ $fasilitas->nama_fasilitas }}">{{ $fasilitas->nama_fasilitas }}</option>
                    @endforeach
                    <option value="all">Semua</option>
                </select>
              </div>
            </div>
          </form>
          <div id="printLaporan">
              <table style="width:100%;border: 1px solid black;border-collapse: collapse;"  id="table">
    
                </table>
                <h4 style="padding-top: 3%">TOTAL</h4>
              <div id="total">
                
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    function printData()
    {
        var divToPrint=document.getElementById("printLaporan");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    $('#print').on('click',function(){
        printData();
    })
  $(document).ready(function ($) {

    // Mencari fasilitas
    $("#fasilitas").change(function () {
      $("#table").empty();
      $("#total").empty();
      $('#table').append(`
      <tr>
        <th  style="border: 1px solid black;border-collapse: collapse;">Fasilitas</th>
        <th style="border: 1px solid black;border-collapse: collapse;">Ruang</th> 
        <th style="border: 1px solid black;border-collapse: collapse;">Asrama</th> 
        <th style="border: 1px solid black;border-collapse: collapse;">Tingkatan</th> 
        <th style="border: 1px solid black;border-collapse: collapse;">Biaya</th> 
        <th style="border: 1px solid black;border-collapse: collapse;">Tanggal Lapor</th> 
        <th style="border: 1px solid black;border-collapse: collapse;">Tanggal Selesai</th> 
        <th style="border: 1px solid black;border-collapse: collapse;">Status</th>
    </tr>
      `)
    var biaya = 0;
      $.ajax({
          type: "get",
          url:
            "/api/ruangan?fasilitas=" +
            $("#fasilitas").val(),
          success: function (res) {
            if (res) {
              $.each(res, function (key, value) {
                $( `<tr> <td style="border: 1px solid black;border-collapse: collapse;">`+ value.nama_fasilitas +`</td>
                <td style="border: 1px solid black;border-collapse: collapse;">`+ value.nama_ruang +`</td>
                <td style="border: 1px solid black;border-collapse: collapse;">`+ value.asrama +`</td>
                <td style="border: 1px solid black;border-collapse: collapse;">`+ value.tingkatan +`</td>
                <td style="border: 1px solid black;border-collapse: collapse;">`+ value.biaya +`</td>
                <td style="border: 1px solid black;border-collapse: collapse;">`+ value.created_at +`</td>
                <td style="border: 1px solid black;border-collapse: collapse;">`+ value.updated_at +`</td>
                <td style="border: 1px solid black;border-collapse: collapse;">`+ value.nama_fasilitas +` telah siap</td></tr>`
                ).appendTo( "#table" );
                biaya+=parseInt(value.biaya.replace('Rp. ','').replace(/\./g,''))
              });
            $(`<h5> Rp. `+formatNumber(biaya)+`</h5>`).appendTo('#total');
            }
          },
        });
    });
  });
</script>
@endsection