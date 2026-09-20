@extends('layouts.master')

@section('title', 'Data Genre')

@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('genre.create') }}" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-plus"></i> Genre
        </a>
    </div>

    <div class="card-body">

        <table id="table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($genres as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <a href="{{ route('genre.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('genre.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus genre ini?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection