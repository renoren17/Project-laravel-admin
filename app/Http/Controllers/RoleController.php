<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:45', 'unique:roles,nama'],
        ]);

        Role::create($data);

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }
}
