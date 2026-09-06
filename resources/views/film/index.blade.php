@extends('layouts.master') {{-- Sesuaikan jika nama file layout utama kamu berbeda --}}

@section('title', 'Data Film')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('film.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Film
        </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped table-bordered m-0">
            <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Judul</th>
                    <th>Ringkasan</th>
                    <th>Tahun</th>
                    <th>Genre</th>
                    <th>Poster</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($film as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ Str::limit($item->ringkasan, 50) }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->genre->nama ?? '-' }}</td>
                        <td>
                            @if($item->poster)
                                <img src="{{ asset('storage/' . $item->poster) }}" width="50" alt="Poster">
                            @else
                                <span class="badge badge-secondary">Tidak ada poster</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('film.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('film.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('film.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-3">Data Masih Kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection