@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Pegaduan</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Kerusakan</div>
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
                            <th class="text-center" style="width: 10%">Action</th>
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
                                        <a href="{{ route('admin.editKerusakan', $laporan->id) }}">
                                            <button type="button" class="btn btn-info">Update</button>
                                        </a>
                                        <form action="{{ route('admin.deleteKerusakan', $laporan) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="ml-2 btn btn-danger" type="submit" onclick="alert('Are you sure want to delete}?')" value="DELETE">
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