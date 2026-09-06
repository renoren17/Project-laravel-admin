@extends('layouts.master')

@section('title', 'Tambah Film')

@section('content')

<h1>Tambah Film</h1>

<form action="{{ route('film.store') }}" method="POST">
    @csrf

    <label>Judul Film</label>
    <input type="text" name="judul">
    <br><br>

    <label>Ringkasan</label>
    <textarea name="ringkasan"></textarea>
    <br><br>

    <label>Tahun</label>
    <input type="number" name="tahun">
    <br><br>

    <label>Poster</label>
    <input type="text" name="poster">
    <br><br>

    <label>Genre</label>
    <select name="genre_id">
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">
                {{ $genre->nama }}
            </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Simpan</button>
    <a href="{{ route('film.index') }}">Kembali</a>

</form>

@endsection