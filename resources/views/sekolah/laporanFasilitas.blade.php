@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Fasilitas {{ $ruangan->first()->tingkatan }}</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Perbaikan</div>
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                @foreach ($ruangan as $key => $ruang)
                <div class="card">
                  <div class="card-header" id="head{{ $key }}">
                    <h2 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                        {{ $ruang->nama_ruang }}
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapse{{ $key }}" class="collapse" aria-labelledby="head{{ $key }}" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Fasilitas</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Total Kerusakan</th>
                                        <th class="text-center" style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Fasilitas</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Total Kerusakan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($fasilitas->where('nama_ruang', $ruang->nama_ruang) as $rusak)
                                        <tr>
                                            <td>{{ $rusak->nama_fasilitas }}</td>
                                            <td>{{ $rusak->jumlah }}</td>
                                            <td>{{ $kerusakan->where('nama_fasilitas', $rusak->nama_fasilitas)->count() }} kali</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('sekolah.editFasilitas', $rusak->fasilitas_id) }}">
                                                        <button type="button" class="btn btn-info">Update</button>
                                                    </a>
                                                    <form class="text-center ml-1" action="{{ route(auth()->user()->level.'.deleteFasilitas', $rusak->fasilitas_id) }}" method="post">
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
                @endforeach
              </div>
        </div>
    </div>
</div>
@endsection