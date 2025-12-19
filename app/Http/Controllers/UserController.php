<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        return view('user.listuser', compact('user'));
    }

    public function edit($id){

        $user = User::findOrFail($id);
        return view('user.edituser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('user.index')
            ->with('success', 'Arsip berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'Arsip berhasil dihapus');
    }
}
