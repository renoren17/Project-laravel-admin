@extends('layouts.master')

@section('title', 'Data Profile')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Data Profile</h3>

        <div class="card-tools">
            <a href="{{ route('profiles.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Profile
            </a>
        </div>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th>Umur</th>
                    <th>Bio</th>
                    <th>Alamat</th>
                </tr>
            </thead>

            <tbody>

                @forelse($profiles as $profile)

                    <tr>
                        <td>{{ $profile->id }}</td>
                        <td>{{ $profile->umur }}</td>
                        <td>{{ $profile->bio }}</td>
                        <td>{{ $profile->alamat }}</td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada data profile.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection