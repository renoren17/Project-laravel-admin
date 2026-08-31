@extends('layouts.master')

@section('title', 'Tambah Genre')

@section('content')

<form action="{{ route('genre.store') }}" method="POST">

    @csrf

    <label>Nama Genre</label>
    <input type="text" name="nama">

    <button type="submit">Simpan</button>

</form>

@endsection