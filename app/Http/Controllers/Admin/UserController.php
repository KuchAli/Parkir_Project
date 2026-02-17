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
        $sortMap = [
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
            'az' => ['nama_lengkap', 'asc'],
            'za' => ['nama_lengkap', 'desc'],
        ];
        
        $query = User::query();

        //search & sort

        if (request()->has('search')) {
            $search = request('search');
            $query = User::where('nama_lengkap', 'like', "%$search%")
                ->orWhere('username', 'like', "%$search%");
        } else {
            $query = User::query();
        }


        if (request()->has('sort') && isset($sortMap[request('sort')])) {
            $query->orderBy(...$sortMap[request('sort')]);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $users = $query->paginate(3)->withQueryString();

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
        
        $role = $request->input('role', 'owner'); // default role 'owner' jika tidak disediakan
        $request->validate([
            'nama_lengkap'     => 'required|string|max:100',
            'username'    => 'required|string|unique:user,username',
            'password' => 'required|min:6',
            'status_aktif'     => 'required|in:1,0',
        ]);

        User::create([
            'nama_lengkap'     => $request->nama_lengkap,
            'username'    => $request->username,
            'password' => $request->password, // auto-hash (cast)
            'status_aktif'     => $request->status_aktif,
            'role' => $role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    // =====================
    // FORM EDIT USER
    // =====================
    public function edit($user_id)
    {
        
        $user = User::findOrFail($user_id);
        return view('admin.users.edit', compact('user'));
    }

    // =====================
    // UPDATE USER
    // =====================
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $request->validate([
            'nama_lengkap'     => 'required|string|max:100',
            'username'    => 'required|string|unique:user,username,' . $user_id .',user_id',
            'password' => 'nullable|min:6',
            'status_aktif'     => 'required|in:1,0',
        ]);

        $data = [
            'name'     => $request->nama_lengkap,
            'username'    => $request->username,
            'status_aktif'     => $request->status_aktif,
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
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
