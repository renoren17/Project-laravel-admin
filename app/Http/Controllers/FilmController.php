<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre; // Tambahkan jika butuh mengambil data genre untuk dropdown form
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $film = Film::all();
        return view('film.index', compact('film'));
    }

    // TAMBAHKAN METHOD INI
    public function create()
    {
        $genres = Genre::all(); // Ambil data genre jika form butuh pilih genre
        return view('film.create', compact('genres'));
    }

    // Method untuk menyimpan data film baru dari form
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric',
            'genre_id' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        Film::create([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'tahun' => $request->tahun,
            'genre_id' => $request->genre_id,
            'poster' => $posterPath,
        ]);

        return redirect()->route('film.index')->with('success', 'Film berhasil ditambahkan!');
    }
}