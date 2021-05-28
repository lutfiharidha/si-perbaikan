@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Saya</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Perbaikan</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Pelapor</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Fasilitas</th>
                            <th class="text-center">Tempat</th>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">Nama Pelapor</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Fasilitas</th>
                            <th class="text-center">Tempat</th>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($arrLaporan as $laporan)
                            <tr>
                                <td>{{ $laporan->kerusakan_has_user->name }}</td>
                                <td>{{ $laporan->kerusakan_has_user->jabatan }}</td>
                                <td>{{ $laporan->kerusakan_has_fasilitas->nama_fasilitas }}</td>
                                <td>
                                    {{ $laporan->kerusakan_has_fasilitas->fasilitas_has_ruang->nama_ruang }},
                                    @if($laporan->kerusakan_has_fasilitas->fasilitas_has_ruang->asrama != null)
                                    Asrama 
                                    {{ $laporan->kerusakan_has_fasilitas->fasilitas_has_ruang->asrama }}, 
                                    @endif
                                    {{ $laporan->kerusakan_has_fasilitas->fasilitas_has_ruang->tingkatan }}
                                </td>
                                <td>{{ $laporan->biaya }}</td>
                                <td>{{ $laporan->status }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('sekolah.editKerusakan', $laporan->id) }}">
                                            <button type="button" class="btn btn-info" @if($laporan->biaya == null) disabled @endif>Update</button>
                                        </a>
                                        <form action="{{ route('sekolah.deleteKerusakan', $laporan->id) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="ml-2 btn btn-danger show_confirm" type="submit" value="DELETE" @if($laporan->status == 'Proses') disabled @endif>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
        }
    });
</script>
@endsection