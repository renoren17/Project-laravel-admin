@extends('layouts.master')

@section('title', 'Detail Film')

@section('content')

<h1>Detail Film</h1>

<p>
    <strong>Judul:</strong>
    {{ $film->judul }}
</p>

<p>
    <strong>Tahun:</strong>
    {{ $film->tahun }}
</p>

<p>
    <strong>Genre:</strong>
    {{ $film->genres->pluck('nama')->join(', ') ?: '-' }}
</p>

<p>
    <strong>Trailer URL:</strong>
    {{ $film->trailer_url }}
</p>

{{-- TRAILER --}}
@if($film->trailer_url)

    @php
        $videoId = null;

        preg_match(
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&?\/]+)/',
            $film->trailer_url,
            $matches
        );

        $videoId = $matches[1] ?? null;
    @endphp

    <div style="margin: 25px 0;">

        <a href="{{ $film->trailer_url }}"
           target="_blank"
           rel="noopener noreferrer"
           style="
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 9px 18px;
                background-color: white;
                color: #222;
                border: 1px solid #999;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
           ">
            ▶ TRAILER
        </a>

        @if($videoId)
            <div style="margin-top: 15px;">

                <a href="{{ $film->trailer_url }}"
                   target="_blank"
                   rel="noopener noreferrer">

                    <img
                        src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                        alt="Trailer {{ $film->judul }}"
                        style="
                            width: 360px;
                            max-width: 100%;
                            border-radius: 10px;
                            border: 1px solid #ccc;
                            display: block;
                        "
                    >

                </a>

            </div>
        @endif

    </div>

@endif

{{-- RINGKASAN --}}
<p>
    <strong>Ringkasan:</strong>
    {{ $film->ringkasan }}
</p>

{{-- POSTER --}}
<p>
    <strong>Poster:</strong>
</p>

@if($film->poster)

    <img
        src="{{ asset($film->poster) }}"
        width="200"
        alt="Poster {{ $film->judul }}"
    >

@else

    <p>Tidak ada poster.</p>

@endif

<br><br>

{{-- CAST --}}
<p>
    <strong>Cast:</strong>
</p>

@if($film->cast->count())

    <ul>
        @foreach($film->cast as $cast)
            <li>{{ $cast->nama }}</li>
        @endforeach
    </ul>

@else

    <p>-</p>

@endif

<br>

<a href="{{ route('film.edit', $film->id) }}">Edit</a>

<a href="{{ route('film.index') }}">Kembali</a>

@endsection