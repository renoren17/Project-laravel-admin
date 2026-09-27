<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
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

        return view('film.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric',
            'genre_id' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('poster');
        $fileName = time() . '_' . preg_replace('/\s+/', '_', strtolower($file->getClientOriginalName()));
        $file->move(public_path('images/posters'), $fileName);

        Film::create([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'tahun' => $request->tahun,
            'genre_id' => $request->genre_id,
            'poster' => 'images/posters/' . $fileName,
        ]);

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
        $film->load('genre', 'cast');

        return view('film.public-show', compact('film'));
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();

        return view('film.edit', compact('film', 'genres'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric',
            'genre_id' => 'required',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'tahun' => $request->tahun,
            'genre_id' => $request->genre_id,
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

        return redirect()
            ->route('film.index')
            ->with('success', 'Film berhasil diperbarui!');
    }

    public function destroy(Film $film)
    {
        if ($film->poster && file_exists(public_path($film->poster))) {
            unlink(public_path($film->poster));
        }

        $film->delete();

        return redirect()
            ->route('film.index')
            ->with('success', 'Film berhasil dihapus!');
    }
}