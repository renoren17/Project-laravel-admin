<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casts = DB::table('casts')->get();
        return view('cast.index', compact('casts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cast.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
        'nama'  => 'required|min:3',
        'umur'  => 'required|numeric',
        'bio'   => 'required',
        ]);

        // Simpan data ke tabel casts
        DB::table('casts')->insert([
        'nama' => $request['nama'],
        'umur' => $request['umur'],
        'bio'  => $request['bio'],
        ]);

        // Redirect ke halaman index
        return redirect()->route('cast.index')->with(['success' => 'Data Telah ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cast = DB::table('casts')->where('id', $id)->first();
        return view('cast.edit', compact('cast'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|min:5',
            'umur' => 'required|numeric',
            'bio' => 'required',
        ]);

        DB::table('casts')
            ->where('id', $id)
            ->update([
                'nama' => $request['nama'],
                'umur' => $request['umur'],
                'bio' => $request['bio'],
            ]);

            return redirect()->route('cast.index')->with(['success'=>'Data berhasil diupdate!!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('casts')->where('id', $id)->delete();
        return redirect()->route('cast.index')->with(['success'=>'Data berhasil dihapus']);
    }
}
