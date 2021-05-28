@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Fasilitas</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>
            Data Fasilitas
            <div class="float-right">
                <a href="{{ route(auth()->user()->level.'.inputFasilitas') }}"><button type="button" class="btn btn-primary">Tambah Fasilitas</button></a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Fasilitas</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Asrama</th>
                            <th class="text-center">Tingkatan</th>
                            <th class="text-center" style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">Fasilitas</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Asrama</th>
                            <th class="text-center">Tingkatan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($fasilitas as $laporan)
                            <tr>
                                <td>{{ $laporan->nama_fasilitas }}</td>
                                <td>{{ $laporan->jumlah }}</td>
                                <td>{{ $laporan->fasilitas_has_ruang->nama_ruang }}</td>
                                <td>{{ $laporan->fasilitas_has_ruang->asrama }}</td>
                                <td>{{ $laporan->fasilitas_has_ruang->tingkatan }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.editFasilitas', $laporan->id) }}">
                                            <button type="button" class="btn btn-info">Update</button>
                                        </a>
                                        <form class="text-center ml-1" action="{{ route(auth()->user()->level.'.deleteFasilitas', $laporan) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="btn btn-danger show_confirm" type="submit" value="DELETE">
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