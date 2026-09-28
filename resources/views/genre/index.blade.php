@extends('layouts.master')

@section('title', 'Data Genre')

@push('css')
<style>
    .data-card { border: 0; box-shadow: 0 2px 8px rgba(32, 33, 36, .08); }
    .data-card .card-header { align-items: center; background: #fff; border-bottom: 1px solid #edf0f2; display: flex; justify-content: space-between; }
    .data-card .card-header > .btn { margin-left: auto; }
    .data-card .table-bordered, .data-card .table-bordered td, .data-card .table-bordered th { border-color: #dee2e6; }
    .action-buttons { display: inline-flex; gap: .35rem; }
    .action-buttons .btn { align-items: center; display: inline-flex; justify-content: center; }
</style>
@endpush

@section('content')

<div class="card data-card">
    <div class="card-header">
        <h3 class="card-title font-weight-bold mb-0"><i class="fas fa-film text-info mr-2"></i>Daftar Genre</h3>
        @can('admin')
            <a href="{{ route('genre.create') }}" class="btn btn-sm btn-info">
                <i class="fas fa-plus mr-1"></i>Tambah Genre
            </a>
        @endcan
    </div>

    <div class="card-body">

        <div class="table-responsive">
        <table id="table" class="table table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    @can('admin')
                        <th>Aksi</th>
                    @endcan
                </tr>
            </thead>

            <tbody>
                @forelse ($genres as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        @can('admin')
                        <td>
                                     <div class="action-buttons">
                                     <a href="{{ route('genre.edit', $item->id) }}"
                                         class="btn btn-sm btn-outline-warning" title="Edit genre">
                                          <i class="fas fa-edit"></i><span class="sr-only">Edit</span>
                            </a>

                            <form action="{{ route('genre.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus genre"
                                        onclick="return confirm('Yakin ingin menghapus genre ini?')">
                                    <i class="fas fa-trash"></i><span class="sr-only">Hapus</span>
                                </button>
                            </form>
                            </div>
                        </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->can('admin') ? 3 : 2 }}" class="text-center text-muted py-4">Belum ada data genre.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        </div>

    </div>
</div>

@endsection