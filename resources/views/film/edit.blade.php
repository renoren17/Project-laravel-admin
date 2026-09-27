@extends('layouts.master')

@section('title', 'Edit Film')

@section('content')

<h1>Edit Film</h1>

<form action="{{ route('film.update', $film->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Judul Film</label>
    <input type="text" name="judul" value="{{ $film->judul }}">
    <br><br>

    <label>Ringkasan</label>
    <textarea name="ringkasan">{{ $film->ringkasan }}</textarea>
    <br><br>

    <label>Tahun</label>
    <input type="number" name="tahun" value="{{ $film->tahun }}">
    <br><br>

    <label>Poster saat ini</label><br>
    @if($film->poster)
        <img src="{{ asset($film->poster) }}" width="100"><br>
    @endif
    <input type="file" name="poster" accept="image/*">
    <br><br>

    <label>Genre</label>
    <select name="genre_id[]" multiple>
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}"
                @if($film->genres->pluck('id')->contains($genre->id)) selected @endif>
                {{ $genre->nama }}
            </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Update</button>
    <a href="{{ route('film.index') }}">Kembali</a>

</form>

@endsection