@extends('layouts.master')

@section('title', 'Data Profile')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Data Profile</h3>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('profile'))
            <div class="alert alert-danger">{{ $errors->first('profile') }}</div>
        @endif

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Bio</th>
                    <th>Role</th>
                    @can('owner')
                        <th width="12%">Aksi</th>
                    @endcan
                </tr>
            </thead>

            <tbody>

                @forelse($profiles as $profile)

                    <tr>
                        <td>{{ $profile->id }}</td>
                        <td>{{ $profile->user?->name ?? $profile->nama ?? '-' }}</td>
                        <td>{{ $profile->user?->email ?? $profile->email ?? '-' }}</td>
                        <td>{{ $profile->bio }}</td>
                        <td>{{ $profile->user?->role?->nama ?? $profile->role ?? '-' }}</td>
                        @can('owner')
                            <td>
                                @if($profile->user)
                                    <form method="POST" action="{{ route('profiles.fire', $profile) }}" onsubmit="return confirm('Pecat akun {{ $profile->user->name }}? Akun dan profile akan dihapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Pecat akun user">
                                            <i class="fas fa-user-slash mr-1"></i>Memecat
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('profiles.destroy', $profile) }}" onsubmit="return confirm('Hapus profile ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus profile">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        @endcan
                    </tr>

                @empty

                    <tr>
                        <td colspan="{{ auth()->user()->can('owner') ? 6 : 5 }}" class="text-center">
                            Belum ada data profile.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection