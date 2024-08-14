<?php

namespace App\Http\Controllers;

use App\Models\BobotKerja;
use Illuminate\Http\Request;

class BobotKerjaController extends Controller
{
    public function index()
    {
        $bobotkerjas = BobotKerja::all();
        return view('bobotkerjas.index', compact('bobotkerjas'));
    }

    public function create()
    {
        return view('bobotkerjas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bobot' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        BobotKerja::create([
            'nama_bobot' => $request->nama_bobot,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('bobotkerjas.index')->with('success', 'Bobot Kerja Berhasil Di Tambahkan.');
    }

    public function edit($id)
    {
        $bobotKerja = BobotKerja::findOrFail($id);
        return view('bobotkerjas.edit', compact('bobotKerja'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bobot' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $bobotKerja = BobotKerja::findOrFail($id);
        $bobotKerja->update([
            'nama_bobot' => $request->nama_bobot,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('bobotkerjas.index')->with('success', 'Bobot Kerja Berhasil Di Perbarui.');
    }

    public function destroy($id)
    {
        $bobotKerja = BobotKerja::findOrFail($id);
        $bobotKerja->delete();

        return redirect()->route('bobotkerjas.index')->with('success', 'Bobot Kerja Berhasil Di Hapus.');
    }
}