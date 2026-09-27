@extends('layouts.master')

@section('title', 'Tambah Profile')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Tambah Profile</h3>
    </div>

    <form action="{{ route('profiles.store') }}" method="POST">

        @csrf

        <div class="card-body">

            {{-- Nama --}}
            <div class="form-group">
                <label>Nama</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan nama"
                    value="{{ old('nama') }}"
                >

                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                >

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Bio --}}
            <div class="form-group">
                <label>Bio</label>
                <textarea
                    name="bio"
                    class="form-control"
                    rows="4"
                    placeholder="Masukkan bio"
                >{{ old('bio') }}</textarea>

                @error('bio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Role --}}
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">

                    <option value="">-- Pilih Role --</option>

                    <option value="admin"
                        {{ old('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="user"
                        {{ old('role') == 'user' ? 'selected' : '' }}>
                        User
                    </option>

                </select>

                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="card-footer">

            <a href="{{ route('profiles.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>

        </div>

    </form>

</div>

@endsection