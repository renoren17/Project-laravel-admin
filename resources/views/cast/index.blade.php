@extends('layouts.master')

@section('title', 'Data Cast')

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
<div class="row">
  <div class="col-12">
    <div class="card data-card">
      <div class="card-header">
        <h3 class="card-title font-weight-bold mb-0"><i class="fas fa-user-tie text-info mr-2"></i>Daftar Cast</h3>
        @can('admin')
          <a href="{{ route('cast.create') }}" class="btn btn-sm btn-info">
            <i class="fas fa-plus mr-1"></i>Tambah Cast
          </a>
        @endcan
      </div>
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success border-0">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
        <table id="table" class="table table-bordered table-hover mb-0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Umur</th>
              <th>Bio</th>
              @can('admin')
                <th class="text-right">Aksi</th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @forelse ($casts as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->umur }}</td>
                <td>{{ $value->bio }}</td>
                @can('admin')
                <td class="text-right">
                  <div class="action-buttons">
                  <a href="{{ route('cast.edit', $value->id) }}" class="btn btn-sm btn-outline-warning" title="Edit cast">
                    <i class="fas fa-edit"></i><span class="sr-only">Edit</span>
                  </a>
                  <form action="{{ route('cast.delete', $value->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus cast" onclick="return confirm('Yakin mau hapus data ini?')">
                      <i class="fas fa-trash"></i><span class="sr-only">Hapus</span>
                    </button>
                  </form>
                  </div>
                </td>
                @endcan
              </tr>
            @empty
              <tr>
                <td colspan="{{ auth()->user()->can('admin') ? 5 : 4 }}" class="text-center text-muted py-4">Belum ada data cast.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection