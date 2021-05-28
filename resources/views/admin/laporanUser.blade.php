@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan User</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>
            Data User
            <div class="float-right">
                <a href="{{ route('inputUser') }}"><button type="button" class="btn btn-info">Tambah User</button></a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Created</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Created</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->level }}</td>
                                <td>{{ $user->jabatan }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date('d-F-Y', strtotime($user->created_at)) }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.editUser', $user->id) }}">
                                            <button type="button" class="btn btn-info">Update</button>
                                        </a>
                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="ml-2 btn btn-danger show_confirm" type="submit" value="DELETE">
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