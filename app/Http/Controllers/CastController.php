<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cast;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::all();
        return view('cast.index', compact('casts'));
    }

    public function create()
    {
        return view('cast.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama'  => 'required|min:3',
        'umur'  => 'required|numeric',
        'bio'   => 'required',
        ]);

        Cast::create([
        'nama' => $request['nama'],
        'umur' => $request['umur'],
        'bio'  => $request['bio'],
        ]);

        return redirect()->route('cast.index')->with(['success' => 'Data Telah ditambahkan']);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $cast = Cast::findOrFail($id);
        return view('cast.edit', compact('cast'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|min:5',
            'umur' => 'required|numeric',
            'bio' => 'required',
        ]);

        $cast = Cast::findOrFail($id);
        $cast->update([
            'nama' => $request['nama'],
            'umur' => $request['umur'],
            'bio' => $request['bio'],
        ]);

            return redirect()->route('cast.index')->with(['success'=>'Data berhasil diupdate!!']);
    }

    public function destroy(string $id)
    {
        $cast = Cast::findOrFail($id);
        $cast->delete();
        return redirect()->route('cast.index')->with(['success'=>'Data berhasil dihapus']);
    }
}