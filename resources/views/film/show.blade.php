@extends('layouts.master')

@section('title', 'Detail Film')

@section('content')

<h1>Detail Film</h1>

<p>
    <strong>Judul:</strong>
    {{ $film->judul }}
</p>

<p>
    <strong>Ringkasan:</strong>
    {{ $film->ringkasan }}
</p>

<p>
    <strong>Tahun:</strong>
    {{ $film->tahun }}
</p>

<p>
    <strong>Genre:</strong>
    {{ $film->genre->nama ?? '-' }}
</p>

<p>
    <strong>Poster:</strong>
</p>

@if($film->poster)
    <img src="{{ asset($film->poster) }}"
         width="200"
         alt="Poster {{ $film->judul }}">
@else
    <p>Tidak ada poster.</p>
@endif

<br><br>

<a href="{{ route('film.edit', $film->id) }}">Edit</a>
<a href="{{ route('film.index') }}">Kembali</a>

@endsection
