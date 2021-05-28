@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Ruang</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>
            Data Ruang
            <div class="float-right">
                <a href="{{ route(auth()->user()->level.'.inputRuang') }}"><button type="button" class="btn btn-info">Tambah Ruang</button></a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Asrama</th>
                            <th class="text-center">Tingkatan</th>
                            <th class="text-center" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Asrama</th>
                            <th class="text-center">Tingkatan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($ruang as $laporanRuang)
                            <tr>
                                <td>{{ $laporanRuang->nama_ruang }}</td>
                                @if($laporanRuang->asrama == null)
                                <td>-</td>
                                @else
                                <td>{{ $laporanRuang->asrama }}</td>

                                @endif
                                <td>{{ $laporanRuang->tingkatan }}</td>
                                <td  class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route(auth()->user()->level.'.editRuang', $laporanRuang) }}">
                                            <button type="button" class="btn btn-info">Update</button>
                                        </a>
                                        <form class="text-center  ml-1" action="{{ route(auth()->user()->level.'.deleteRuang', $laporanRuang) }}" method="post">
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