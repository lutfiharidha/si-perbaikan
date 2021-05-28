@extends('layouts.app') @section('content')
<div class="container-fluid">
  <h1 class="mt-4">Kalkulasi Perbaikan Fasilitas</h1>
  <div class="card mt-4 mb-4">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>Penambahan Fasilitas
      </div>
      <div class="card-body">
        <form method="POST" action="{{route('admin.updateKerusakan', $kerusakan)}}" enctype="multipart/form-data">
          @csrf
          {{ method_field('PUT') }}
          <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="exampleFormControlSelect1">Fasilitas</label>
                    <input class="form-control" type="text" placeholder="{{ $kerusakan->kerusakan_has_fasilitas->nama_fasilitas }}" readonly>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput2">Total</label>
                    <input class="form-control" type="text" placeholder="{{ $kerusakan->total }}" readonly>
                </div>
            </div>
            </div>
          <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="exampleFormControlInput2">Ruang</label>
                    <input class="form-control" type="text" placeholder="{{ $kerusakan->kerusakan_has_fasilitas->fasilitas_has_ruang->nama_ruang }}" readonly>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput2">Asrama</label>
                    <input class="form-control" type="text" placeholder="{{ $kerusakan->kerusakan_has_fasilitas->fasilitas_has_ruang->asrama }}" readonly>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput2">Tingkatan</label>
                     <input class="form-control" type="text" placeholder="{{ $kerusakan->kerusakan_has_fasilitas->fasilitas_has_ruang->tingkatan }}" readonly>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlSelect1">Gambar Kerusakan</label><br>
                        <img class="w-50" src="{{ url('img/fasilitas/', $kerusakan->foto) }}" alt="">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput2">Biaya</label>
                        <input class="form-control" id="rupiah" name="biaya" type="text" placeholder="Biaya Perbaikan" value="{{ $kerusakan->biaya }}" @if($kerusakan->status != 'Pending') readonly @endif>
                        <br>
                        <label for="exampleFormControlInput2">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3" readonly>{{ $kerusakan->deskripsi }}</textarea>
                        <br>
                        @if($kerusakan->status == 'Approved' || $kerusakan->status == 'Proses')
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Status</label>
                            <select name="status" class="form-control" id="status">
                              <option>-- Pilih Status--</option>
                              <option value="Proses"  @if($kerusakan->status == 'Proses') selected @endif>Proses</option>
                              <option value="Finished" @if($kerusakan->status == 'Finished') selected @endif>Finish</option>
                            </select>
                          </div>
                          @endif
                        <button type="submit" class="btn btn-primary mb-2 float-right">Submit</button>
                    </div>
                </div>
            </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection @section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
 var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function(e){
    rupiah.value = formatRupiah(this.value, 'Rp. ');
});
function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

</script>
@endsection
