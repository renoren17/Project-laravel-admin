@extends('layouts.master')

@section('title', 'Tambah Role')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Role</h3>
    </div>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Role</label>
                <input
                    id="nama"
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Contoh: Admin"
                    value="{{ old('nama') }}"
                    required
                >
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
