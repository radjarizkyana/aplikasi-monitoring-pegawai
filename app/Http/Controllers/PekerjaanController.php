<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use App\Models\Kategori;
use App\Models\BobotKerja;
use Illuminate\Support\Facades\Auth;
use PDF;

class PekerjaanController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        $bobotKerjas = BobotKerja::all();
        return view('pekerjaan.create', compact('kategoris', 'bobotKerjas'));
    }

    public function store(Request $request)
    {
        $pekerjaan = new Pekerjaan;
        $pekerjaan->id_user = Auth::id();
        $pekerjaan->judul_pekerjaan = $request->judul_pekerjaan;
        $pekerjaan->id_kategori = $request->id_kategori;
        $pekerjaan->id_bobot_kerja = $request->id_bobot_kerja;
        $pekerjaan->foto_sebelum = $request->file('foto_sebelum')->store('assets/fotoPekerjaanSebelum', 'public');
    
        if ($request->hasFile('foto_sesudah')) {
            $pekerjaan->foto_sesudah = $request->file('foto_sesudah')->store('assets/fotoPekerjaanSesudah', 'public');
        }

        $pekerjaan->save();

        return redirect()->route('dashboard.index')->with('success', 'Pekerjaan Berhasil Di Tambahkan.');
    }

    public function index()
    {
        $user = Auth::user();
        $pekerjaans = Pekerjaan::with('kategori', 'bobotKerja')
            ->where('id_user', $user->id)
            ->get();

        return view('dashboard.index', compact('pekerjaans'));
    }

    public function edit($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $kategoris = Kategori::all();
        $bobotKerjas = BobotKerja::all();

        return view('pekerjaan.edit', compact('pekerjaan', 'kategoris', 'bobotKerjas'));
    }

    public function update(Request $request, $id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->judul_pekerjaan = $request->judul_pekerjaan;
        $pekerjaan->id_kategori = $request->id_kategori;
        $pekerjaan->id_bobot_kerja = $request->id_bobot_kerja;

        if ($request->hasFile('foto_sebelum')) {
            $pekerjaan->foto_sebelum = $request->file('foto_sebelum')->store('assets/fotoPekerjaanSebelum', 'public');
        }

        if ($request->hasFile('foto_sesudah')) {
            $pekerjaan->foto_sesudah = $request->file('foto_sesudah')->store('assets/fotoPekerjaanSesudah', 'public');
        }

        $pekerjaan->save();

        return redirect()->route('dashboard.index')->with('success', 'Pekerjaan Berhasil Di Perbarui.');
    }

    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();

        return redirect()->route('dashboard.index')->with('success', 'Pekerjaan Berhasil Di Hapus.');
    }

    public function complete($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        return view('pekerjaan.pekerjaanSelesai', compact('pekerjaan'));
    }

    public function completeStore(Request $request, $id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);

        if ($request->hasFile('foto_sesudah')) {
            $pekerjaan->foto_sesudah = $request->file('foto_sesudah')->store('assets/fotoPekerjaanSesudah', 'public');
            $pekerjaan->save();
        }

        return redirect()->route('dashboard.index')->with('success', 'Pekerjaan Berhasil Di Selesaikan.');
    }
}
