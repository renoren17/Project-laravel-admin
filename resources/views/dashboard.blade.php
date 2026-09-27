@extends('layouts.master')

@section('title', 'Dashboard Film')

@push('css')
<style>
    .film-dashboard .hero-panel {
        background: linear-gradient(120deg, #202124 0%, #34302b 62%, #8b4f2f 100%);
        color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .film-dashboard .hero-panel h2 {
        font-weight: 700;
        letter-spacing: .2px;
    }

    .film-dashboard .stat-card {
        border: 0;
        border-left: 4px solid #f4b942;
        box-shadow: 0 2px 8px rgba(32, 33, 36, .08);
    }

    .film-dashboard .stat-card .stat-icon {
        color: #f4b942;
        font-size: 2rem;
    }

    .film-dashboard .poster-tile {
        min-height: 164px;
        border-radius: 6px;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 14px;
        position: relative;
        overflow: hidden;
    }

    .film-dashboard .poster-tile::after {
        background: linear-gradient(transparent, rgba(0, 0, 0, .72));
        content: '';
        inset: 0;
        position: absolute;
    }

    .film-dashboard .poster-tile > * {
        position: relative;
        z-index: 1;
    }

    .film-dashboard .poster-one { background: linear-gradient(145deg, #183b56, #5c2c43); }
    .film-dashboard .poster-two { background: linear-gradient(145deg, #3b4d31, #b05d35); }
    .film-dashboard .poster-three { background: linear-gradient(145deg, #49336b, #bd6b47); }
    .film-dashboard .poster-four { background: linear-gradient(145deg, #263238, #a63d40); }

    .film-dashboard .poster-tile h5 {
        font-size: 1rem;
        margin: 0;
    }

    .film-dashboard .poster-tile small {
        color: rgba(255, 255, 255, .78);
    }

    .film-dashboard .section-card {
        border: 0;
        box-shadow: 0 2px 8px rgba(32, 33, 36, .08);
    }
</style>
@endpush

@section('content')
<div class="film-dashboard">
    <div class="hero-panel p-4 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <p class="text-uppercase mb-2 small font-weight-bold" style="color: #f4b942; letter-spacing: 1px;">CineCatalog</p>
                <h2 class="mb-2">Kelola dunia film kamu.</h2>
                <p class="mb-0 text-white-50">Pantau koleksi film, genre, cast, dan kritik dari satu tempat.</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <i class="fas fa-film fa-4x" style="color: #f4b942;"></i>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div><h3 class="mb-1">{{ $totalFilms }}</h3><p class="text-muted mb-0">Total Film</p></div>
                    <i class="fas fa-video stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card stat-card" style="border-left-color: #d95d39;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div><h3 class="mb-1">{{ $totalGenres }}</h3><p class="text-muted mb-0">Genre</p></div>
                    <i class="fas fa-layer-group stat-icon" style="color: #d95d39;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card stat-card" style="border-left-color: #4f8a8b;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div><h3 class="mb-1">{{ $totalCasts }}</h3><p class="text-muted mb-0">Cast</p></div>
                    <i class="fas fa-users stat-icon" style="color: #4f8a8b;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card stat-card" style="border-left-color: #7b6d8d;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div><h3 class="mb-1">{{ $totalRoles }}</h3><p class="text-muted mb-0">Role</p></div>
                    <i class="fas fa-user-shield stat-icon" style="color: #7b6d8d;"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card section-card">
                <div class="card-header bg-white border-0 pt-3">
                    <h3 class="card-title font-weight-bold">Film Terbaru</h3>
                    <a href="{{ route('film.index') }}" class="float-right text-dark small">Lihat semua <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
                <div class="card-body pt-1">
                    @if($latestFilms->isEmpty())
                        <div class="alert alert-light mb-0">Belum ada film yang ditambahkan.</div>
                    @else
                        <div class="row">
                            @foreach($latestFilms as $film)
                                <div class="col-sm-6 col-xl-3 mb-3 mb-xl-0">
                                    <a href="{{ route('movie.show', $film->id) }}" class="text-decoration-none text-white">
                                        <div class="poster-tile" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.1), rgba(0,0,0,0.8)), url('{{ $film->poster ? asset($film->poster) : 'https://placehold.co/600x900/1f2937/ffffff?text=' . urlencode($film->judul) }}'); background-size: cover; background-position: center; min-height: 220px;">
                                            <h5>{{ $film->judul }}</h5>
                                            <small>{{ $film->genres->pluck('nama')->join(', ') ?: 'Genre' }} · {{ $film->tahun }}</small>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card section-card">
                <div class="card-header bg-white border-0 pt-3"><h3 class="card-title font-weight-bold">Genre Populer</h3></div>
                <div class="card-body pt-1">
                    @php
                        $barColors = ['bg-warning', 'bg-danger', 'bg-info', 'bg-success'];
                    @endphp

                    @forelse($popularGenres as $index => $genre)
                        <div class="progress-group{{ $loop->last ? ' mb-0' : '' }}">
                            {{ $genre->nama }}
                            <span class="float-right"><b>{{ $genre->films_count }}</b>/{{ $totalFilms }}</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar {{ $barColors[$index % count($barColors)] }}"
                                    style="width: {{ $totalFilms > 0 ? round(($genre->films_count / $totalFilms) * 100) : 0 }}%">
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Belum ada data genre.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card section-card mt-2">
        <div class="card-header bg-white border-0 pt-3"><h3 class="card-title font-weight-bold">Kritik Terbaru</h3></div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover mb-0">
                <thead><tr><th class="pl-3">Film</th><th>Pengguna</th><th>Rating</th><th>Komentar</th></tr></thead>
                <tbody>
                    @forelse($latestKritiks as $kritik)
                        <tr>
                            <td class="pl-3 font-weight-bold">{{ $kritik->film->judul ?? 'Film' }}</td>
                            <td>{{ $kritik->user->name ?? 'Pengguna' }}</td>
                            <td>
                                @php
                                    $stars = str_repeat('★', $kritik->point ?? 0);
                                    $emptyStars = str_repeat('☆', max(5 - ($kritik->point ?? 0), 0));
                                @endphp
                                <span class="text-warning">{{ $stars }}{{ $emptyStars }}</span>
                            </td>
                            <td class="text-muted">{{ Str::limit($kritik->content, 80) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada kritik film.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection