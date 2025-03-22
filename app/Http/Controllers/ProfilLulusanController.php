<?php

namespace App\Http\Controllers;

use App\Models\ProfilLulusan;
use Illuminate\Http\Request;

class ProfilLulusanController extends Controller
{
    public function index() {
        $data = ProfilLulusan::all();
        return view('profil_lulusan.index', compact('data'));
    }

    public function store(Request $request) {
        $request->validate([
            'kode_pl' => 'required|unique:profil_lulusan',
            'profil_lulusan' => 'required',
            'profesi' => 'required'
        ]);

        ProfilLulusan::create($request->all());
        return redirect()->route('profil-lulusan.index')->with('success', 'Data berhasil ditambah!');
    }

    public function update(Request $request, $id) {
        $profilLulusan = ProfilLulusan::findOrFail($id);
        $profilLulusan->kode_pl = $request->kode_pl;
        $profilLulusan->profil_lulusan = $request->profil_lulusan;
        $profilLulusan->profesi = $request->profesi;
        $profilLulusan->save();
    
        return redirect()->route('profil-lulusan.index')->with('success', 'Data berhasil diperbarui.');
    }
    

    public function destroy($id) {
        ProfilLulusan::find($id)->delete();
        return redirect()->route('profil-lulusan.index')->with('success', 'Data berhasil dihapus!');
    }
}
