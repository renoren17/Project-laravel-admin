@extends('layouts.master') {{-- Sesuaikan jika nama file layout utama kamu berbeda --}}

@section('title', 'Data Film')

@push('css')
<style>
    .film-list-card { border: 0; box-shadow: 0 2px 8px rgba(32, 33, 36, .08); }
    .film-list-card .card-header { align-items: center; background: #fff; border-bottom: 1px solid #edf0f2; display: flex; justify-content: space-between; }
    .film-list-card .card-header > .btn { margin-left: auto; }
    .film-list-card .table-bordered, .film-list-card .table-bordered td, .film-list-card .table-bordered th { border-color: #dee2e6; }
    .film-actions { display: inline-flex; gap: .3rem; white-space: nowrap; }
    .film-actions .btn { align-items: center; display: inline-flex; justify-content: center; }
    .film-poster { border-radius: 4px; height: 58px; object-fit: cover; width: 42px; }
</style>
@endpush

@section('content')
<div class="card film-list-card">
    <div class="card-header">
        <h3 class="card-title font-weight-bold mb-0"><i class="fas fa-film text-info mr-2"></i>Daftar Film</h3>
        @can('admin')
            <a href="{{ route('film.create') }}" class="btn btn-info btn-sm">
                <i class="fas fa-plus mr-1"></i>Tambah Film
            </a>
        @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover table-bordered m-0">
            <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Judul</th>
                    <th>Ringkasan</th>
                    <th>Tahun</th>
                    <th>Genre</th>
                    <th>Poster</th>
                    @can('admin')
                        <th style="width: 150px">Aksi</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($film as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ Str::limit($item->ringkasan, 50) }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->genres->pluck('nama')->join(', ') ?: '-' }}</td>
                        <td>
                            @if($item->poster)
                                <img src="{{ asset($item->poster) }}" class="film-poster" alt="Poster {{ $item->judul }}">
                            @else
                                <span class="badge badge-secondary">Tidak ada poster</span>
                            @endif
                        </td>
                        @can('admin')
                        <td class="text-right">
                            <div class="film-actions">
                            <form action="{{ route('film.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('film.show', $item->id) }}" class="btn btn-outline-info btn-sm" title="Lihat detail">
                                    <i class="fas fa-eye"></i><span class="sr-only">Detail</span>
                                </a>
                                <a href="{{ route('film.edit', $item->id) }}" class="btn btn-outline-warning btn-sm" title="Edit film">
                                    <i class="fas fa-edit"></i><span class="sr-only">Edit</span>
                                </a>
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus film" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i><span class="sr-only">Hapus</span>
                                </button>
                            </form>
                            </div>
                        </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->can('admin') ? 7 : 6 }}" class="text-center text-muted py-4">Belum ada data film.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
@endsection