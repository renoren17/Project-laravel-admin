@extends('layouts.master')

@section('title', 'Edit Genre')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Genre</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('genre.update', $genre->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Genre</label>

                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="form-control"
                    value="{{ $genre->nama }}"
                    required
                >
            </div>

            <a href="{{ route('genre.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
        </form>

    </div>
</div>

@endsection