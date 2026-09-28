<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::with('user.role')->get();

        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'bio' => 'required|string',
            'role' => 'required|string',
        ]);

        Profile::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'bio' => $request->bio,
            'role' => $request->role,
        ]);

        return redirect()->route('profiles.index')
            ->with('success', 'Profile berhasil ditambahkan!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile): RedirectResponse
    {
        if ($profile->user()->exists()) {
            return back()->withErrors([
                'profile' => 'Profile tidak dapat dihapus karena masih terhubung ke akun user.',
            ]);
        }

        $profile->delete();

        return redirect()->route('profiles.index')
            ->with('success', 'Profile berhasil dihapus.');
    }

    public function fire(Profile $profile): RedirectResponse
    {
        $user = $profile->user()->with('role')->first();

        if (!$user) {
            return back()->withErrors([
                'profile' => 'Profile ini tidak terhubung ke akun user.',
            ]);
        }

        if (strtolower((string) ($user->role->nama ?? '')) === 'owner') {
            return back()->withErrors([
                'profile' => 'Akun Owner tidak dapat dipecat.',
            ]);
        }

        DB::transaction(function () use ($user, $profile) {
            $user->delete();
            $profile->delete();
        });

        return redirect()->route('profiles.index')
            ->with('success', 'Akun user berhasil dipecat.');
    }
}
