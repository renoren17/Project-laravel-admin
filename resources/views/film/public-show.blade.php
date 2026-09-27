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

    .btn-back {
        margin-top: 12px;
    }
</style>
@endpush

@section('content')
<div class="card movie-card">
    <div class="row no-gutters">
        <div class="col-md-4">
            @if($film->poster)
                <img src="{{ asset('storage/' . $film->poster) }}" class="movie-poster" alt="{{ $film->judul }}">
            @else
                <div class="d-flex align-items-center justify-content-center h-100 p-4 text-center text-muted">
                    Poster belum tersedia.
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="movie-detail-body">
                <div class="movie-badges">
                    <span class="movie-badge">{{ $film->genre->nama ?? 'Genre' }}</span>
                    <span class="movie-badge">{{ $film->tahun }}</span>
                </div>

                <h1>{{ $film->judul }}</h1>
                <div class="movie-meta">{{ $film->genre->nama ?? 'Genre tidak tersedia' }} • {{ $film->tahun }}</div>

                <div>
                    <div class="section-title">Ringkasan</div>
                    <p class="movie-description">{{ $film->ringkasan }}</p>
                </div>

                <div>
                    <div class="section-title">Cast</div>
                    <div class="cast-list">
                        @if(!empty($film->cast) && $film->cast->count())
                            @foreach($film->cast as $cast)
                                <span class="cast-item">{{ $cast->nama }}</span>
                            @endforeach
                        @else
                            <span class="cast-item">Cast belum ditambahkan</span>
                        @endif
                    </div>
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-back">Kembali ke dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
