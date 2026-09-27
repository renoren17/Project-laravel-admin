<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Cast;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $film = Film::all();

        return view('film.index', compact('film'));
    }

    public function create()
    {
        $genres = Genre::all();
        $casts = Cast::all();

        return view('film.create', compact('genres', 'casts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric',
            'genre_id' => 'required|array',
            'genre_id.*' => 'exists:genres,id',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'trailer_url' => 'nullable|url',
        ]);

        $file = $request->file('poster');

        $fileName = time() . '_' .
            preg_replace(
                '/\s+/',
                '_',
                strtolower($file->getClientOriginalName())
            );

        $file->move(
            public_path('images/posters'),
            $fileName
        );

        $film = new Film();

        $film->judul = $request->judul;
        $film->ringkasan = $request->ringkasan;
        $film->tahun = $request->tahun;
        $film->poster = 'images/posters/' . $fileName;
        $film->trailer_url = $request->trailer_url;

        $film->save();

        $film->genres()->sync($request->genre_id);

        if ($request->filled('cast_id')) {
            $castData = Cast::whereIn('id', $request->cast_id)
                ->get()
                ->mapWithKeys(function ($cast) {
                    return [
                        $cast->id => [
                            'nama' => $cast->nama
                        ]
                    ];
                });

            $film->cast()->sync($castData);
        }

        return redirect()
            ->route('film.index')
            ->with('success', 'Film berhasil ditambahkan!');
    }

    public function show(Film $film)
    {
        $film->load('genres', 'cast');

        return view('film.show', compact('film'));
    }

    public function publicShow(Film $film)
    {
        $film->load('genres', 'cast');

        return view('film.public-show', compact('film'));
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();
        $casts = Cast::all();

        return view(
            'film.edit',
            compact('film', 'genres', 'casts')
        );
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric',
            'genre_id' => 'required|array',
            'genre_id.*' => 'exists:genres,id',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'trailer_url' => 'nullable|url',
        ]);

        $film->judul = $request->judul;
        $film->ringkasan = $request->ringkasan;
        $film->tahun = $request->tahun;
        $film->trailer_url = $request->trailer_url;

        if ($request->hasFile('poster')) {

            if (
                $film->poster &&
                file_exists(public_path($film->poster))
            ) {
                unlink(public_path($film->poster));
            }

            $file = $request->file('poster');

            $fileName = time() . '_' .
                preg_replace(
                    '/\s+/',
                    '_',
                    strtolower($file->getClientOriginalName())
                );

            $file->move(
                public_path('images/posters'),
                $fileName
            );

            $film->poster = 'images/posters/' . $fileName;
        }

        $film->save();

        $film->genres()->sync($request->genre_id);

        if ($request->filled('cast_id')) {

            $castData = Cast::whereIn('id', $request->cast_id)
                ->get()
                ->mapWithKeys(function ($cast) {
                    return [
                        $cast->id => [
                            'nama' => $cast->nama
                        ]
                    ];
                });

            $film->cast()->sync($castData);

        } else {

            $film->cast()->sync([]);

        }

        return redirect()
            ->route('film.index')
            ->with('success', 'Film berhasil diperbarui!');
    }

    public function destroy(Film $film)
    {
        if (
            $film->poster &&
            file_exists(public_path($film->poster))
        ) {
            unlink(public_path($film->poster));
        }

        $film->cast()->detach();
        $film->genres()->detach();
        $film->delete();

        return redirect()
            ->route('film.index')
            ->with('success', 'Film berhasil dihapus!');
    }
}