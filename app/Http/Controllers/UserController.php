<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function index()
    {
        $user = Auth::user(); // Hanya mengambil user yang sedang login
        return view('users.index', compact('user'));
    }

    // Menampilkan halaman edit profil
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Pastikan hanya user yang sedang login yang bisa mengedit
        if ($user->id !== Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak memiliki izin untuk mengedit profil ini.');
        }

        return view('users.edit', compact('user'));
    }

    // Menyimpan perubahan profil pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Profil berhasil diperbarui.');
    }

    // Update status aktivitas user secara otomatis
    public function updateActivity()
    {
        if (Auth::check()) {
            DB::table('users')
                ->where('id', Auth::id())
                ->update(['last_active_at' => Carbon::now()]);
        }

        return response()->json(['message' => 'Status aktivitas diperbarui']);
    }

    // Menampilkan daftar pengguna untuk admin
    public function adminIndex()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }
}
