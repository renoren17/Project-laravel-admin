<?php

namespace App\Http\Controllers;

use App\Models\AdminCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OwnerController extends Controller
{
    public function index()
    {
        $codes = AdminCode::with('user')->latest()->get();

        return view('owner.admin-codes', compact('codes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:50'],
            'no_id' => ['required', 'string', 'max:50'],
        ]);

        do {
            $kode = 'ADM-' . strtoupper(Str::random(8));
        } while (AdminCode::where('kode', $kode)->exists());

        $code = AdminCode::create([
            'nama' => $data['nama'],
            'no_id' => $data['no_id'],
            'kode' => $kode,
            'user_id' => null,
        ]);

        return redirect()->route('owner.admin-codes')
            ->with('success', 'Kode admin dibuat: ' . $code->kode);
    }
}
