<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ]);

        $file = $request->file('poster');
        $fileName = time() . '_' . preg_replace('/\s+/', '_', strtolower($file->getClientOriginalName()));
        $file->move(public_path('images/posters'), $fileName);

        $film = Film::create([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'tahun' => $request->tahun,
            'poster' => 'images/posters/' . $fileName,
        ]);

        $film->genres()->sync($request->genre_id);

        if ($request->filled('cast_id')) {
            $castData = Cast::whereIn('id', $request->cast_id)
                ->get()
                ->mapWithKeys(fn($cast) => [$cast->id => ['nama' => $cast->nama]]);

            $film->cast()->sync($castData);
        }

        return redirect()
            ->route('film.index')
            ->with('success', 'Film berhasil ditambahkan!');
    }

    public function show(Film $film)
    {
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

        return view('film.edit', compact('film', 'genres', 'casts'));
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
        ]);

        $data = [
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'tahun' => $request->tahun,
        ];

        if ($request->hasFile('poster')) {
            if ($film->poster && file_exists(public_path($film->poster))) {
                unlink(public_path($film->poster));
            }

            $file = $request->file('poster');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', strtolower($file->getClientOriginalName()));
            $file->move(public_path('images/posters'), $fileName);

            $data['poster'] = 'images/posters/' . $fileName;
        }

        $film->update($data);
        $film->genres()->sync($request->genre_id);

        if ($request->filled('cast_id')) {
            $castData = Cast::whereIn('id', $request->cast_id)
                ->get()
                ->mapWithKeys(fn($cast) => [$cast->id => ['nama' => $cast->nama]]);

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
        if ($film->poster && file_exists(public_path($film->poster))) {
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