@extends('layouts.master')

@section('title', 'Data Role')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Role</h3>
        <div class="card-tools">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Role
            </a>
        </div>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="alert alert-info">
            Role di sini berguna untuk membedakan hak akses user: <strong>Admin</strong> untuk CRUD dan <strong>User</strong> untuk melihat dashboard dan film.
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th>Nama Role</th>
                    <th width="25%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->nama }}</td>
                        <td>
                            @if(strtolower($role->nama) === 'admin')
                                CRUD data
                            @elseif(strtolower($role->nama) === 'user')
                                Lihat dashboard & katalog
                            @else
                                Hak akses khusus
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data role.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
