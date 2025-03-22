<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa mengakses halaman ini
        if (!Gate::allows('admin-access')) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        // Ambil data user dengan role "dosen"
        $users = User::where('role', 'dosen')->get();

        return view('admin.dashboard', compact('users'));
    }

    public function create()
    {
        if (!Gate::allows('admin-access')) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        return view('admin.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('admin-access')) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'is_active' => 'required|in:0,1',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen',
            'is_active' => (int) $request->is_active,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!Gate::allows('admin-access')) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('admin-access')) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'is_active' => 'required|in:0,1',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => (int) $request->is_active,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!Gate::allows('admin-access')) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        User::findOrFail($id)->delete();
        return redirect('/admin/dashboard')->with('success', 'Akun berhasil dihapus.');
    }

    public function resetPassword($id)
{
    if (!Gate::allows('admin-access')) {
        return redirect('/')->with('error', 'Akses ditolak.');
    }

    $user = User::findOrFail($id);
    $newPassword = 'password123'; // Ganti dengan password default

    $user->update([
        'password' => bcrypt($newPassword),
    ]);

    return redirect('/admin/dashboard')->with('success', "Password akun {$user->name} telah direset ke '{$newPassword}'");
}

}
