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

            <div class="form-group">
                <label>Umur</label>
                <input 
                    type="number"
                    name="umur"
                    class="form-control"
                    placeholder="Masukkan umur"
                    value="{{ old('umur') }}"
                >

                @error('umur')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

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

            <div class="form-group">
                <label>Alamat</label>
                <textarea 
                    name="alamat"
                    class="form-control"
                    rows="3"
                    placeholder="Masukkan alamat"
                >{{ old('alamat') }}</textarea>

                @error('alamat')
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