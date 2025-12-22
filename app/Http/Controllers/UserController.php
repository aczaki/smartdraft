<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        return view('user.listuser', compact('user'));
    }

    public function create()
    {
        return view('user.tambahuser');
    }

    
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);
        
        // 2. Simpan ke Database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), 
            'role' => $request->role,
        ]);
        
        // 3. Redirect dengan pesan sukses
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }


// Menampilkan halaman edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edituser', compact('user'));
    }

    // Memproses perubahan data
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'required|min:6|confirmed', // 'confirmed' mewajibkan input password_confirmation
            'role' => 'required|in:admin,user',
        ]);

        // 2. Update Data
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password diganti dengan yang baru
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Data pengguna dan password berhasil diperbarui!');
    }
}
