@extends('layouts.master')

@section('title', 'Detail Film')

@push('css')
<style>
    .movie-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #dee2e6;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .movie-poster {
        width: 100%;
        height: 100%;
        min-height: 420px;
        object-fit: cover;
        background: #f1f3f5;
    }

    .movie-detail-body {
        padding: 30px;
    }

    .movie-badges {
        margin-bottom: 15px;
    }

    .movie-badge {
        display: inline-block;
        margin-right: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: #f4f6f9;
        color: #495057;
        border: 1px solid #dfe5eb;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .movie-detail-body h1 {
        color: #1f2d3d;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .movie-meta {
        color: #6c757d;
        font-size: 0.96rem;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .movie-description {
        color: #495057;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .cast-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .cast-item {
        background: #eef2f7;
        color: #2d3748;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 0.9rem;
        border: 1px solid #dde5ee;
    }

    /* TRAILER */
    .trailer-section {
        margin-bottom: 22px;
    }

    .trailer-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: #ffffff;
        color: #222222;
        border: 1px solid #999999;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.2s;
    }

    .trailer-button:hover {
        background: #f4f4f4;
        color: #111111;
        text-decoration: none;
    }

    .trailer-thumbnail {
        display: block;
        width: 360px;
        max-width: 100%;
        margin-top: 14px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .trailer-thumbnail img {
        display: block;
        width: 100%;
        height: auto;
    }

    .btn-back {
        margin-top: 20px;
    }
</style>
@endpush


@section('content')

<div class="card movie-card">

    <div class="row no-gutters">

        {{-- POSTER --}}
        <div class="col-md-4">

            @if($film->poster)

                <img
                    src="{{ asset($film->poster) }}"
                    class="movie-poster"
                    alt="{{ $film->judul }}"
                >

            @else

                <div class="d-flex align-items-center justify-content-center h-100 p-4 text-center text-muted">
                    Poster belum tersedia.
                </div>

            @endif

        </div>


        {{-- DETAIL FILM --}}
        <div class="col-md-8">

            <div class="movie-detail-body">

                {{-- GENRE + TAHUN --}}
                <div class="movie-badges">

                    @forelse($film->genres as $genre)

                        <span class="movie-badge">
                            {{ $genre->nama }}
                        </span>

                    @empty

                        <span class="movie-badge">
                            Genre
                        </span>

                    @endforelse

                    <span class="movie-badge">
                        {{ $film->tahun }}
                    </span>

                </div>


                {{-- JUDUL --}}
                <h1>
                    {{ $film->judul }}
                </h1>


                {{-- META --}}
                <div class="movie-meta">

                    {{ $film->genres->pluck('nama')->join(', ') ?: 'Genre tidak tersedia' }}

                    • {{ $film->tahun }}

                </div>


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


                    @if($videoId)

                        <div class="trailer-section">

                            <a
                                href="{{ $film->trailer_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="trailer-button"
                            >
                                ▶ Trailer
                            </a>


                            <a
                                href="{{ $film->trailer_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="trailer-thumbnail"
                            >

                                <img
                                    src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                    alt="Trailer {{ $film->judul }}"
                                >

                            </a>

                        </div>

                    @else

                        {{-- Kalau URL ada tetapi bukan format YouTube yang dikenali --}}
                        <div class="trailer-section">

                            <a
                                href="{{ $film->trailer_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="trailer-button"
                            >
                                ▶ Trailer
                            </a>

                        </div>

                    @endif

                @endif


                {{-- RINGKASAN --}}
                <div>

                    <div class="section-title">
                        Ringkasan
                    </div>

                    <p class="movie-description">
                        {{ $film->ringkasan }}
                    </p>

                </div>


                {{-- CAST --}}
                <div>

                    <div class="section-title">
                        Cast
                    </div>

                    <div class="cast-list">

                        @if(!empty($film->cast) && $film->cast->count())

                            @foreach($film->cast as $cast)

                                <span class="cast-item">
                                    {{ $cast->nama }}
                                </span>

                            @endforeach

                        @else

                            <span class="cast-item">
                                Cast belum ditambahkan
                            </span>

                        @endif

                    </div>

                </div>


                {{-- KEMBALI --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="btn btn-primary btn-back"
                >
                    Kembali ke dashboard
                </a>

            </div>

        </div>

    </div>

</div>

@endsection