<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    // =====================
    // TAMPIL DATA USER
    // =====================
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // =====================
    // FORM TAMBAH USER
    // =====================
    public function create()
    { 
       $users = User::all();
        return view('admin.users.create', compact('users'));
    }

    // =====================
    // SIMPAN USER BARU
    // =====================
    public function store(Request $request)
    {
        
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id'     => 'required|in:1,2,3',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password, // auto-hash (cast)
            'role_id'     => $request->role_id,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    // =====================
    // FORM EDIT USER
    // =====================
    public function edit($id)
    {
        
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // =====================
    // UPDATE USER
    // =====================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role_id'     => 'required|in:1,2,3',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'role_id'     => $request->role_id,
        ];

        // hanya update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = $request->password; // auto-hash
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    // =====================
    // HAPUS USER
    // =====================
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
