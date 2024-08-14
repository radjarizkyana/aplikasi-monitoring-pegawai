<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPegawai;
use App\Models\Jabatan;

class UserController extends Controller
{
    public function create()
    {
        $jabatans = Jabatan::all();
        return view('users.create', compact('jabatans'));
    }

    public function index()
    {
        $users = User::with('userPegawai.jabatan')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $userPegawai = UserPegawai::create([
            'id_jabatan' => $request->id_jabatan,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        User::create([
            'id_pegawai' => $userPegawai->id,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'admin' => 0,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna Berhasil Di Tambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $userPegawai = $user->userPegawai;
        $jabatans = Jabatan::all();
        return view('users.edit', compact('user', 'userPegawai', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $userPegawai = $user->userPegawai;

        $user->update([
            'username' => $request->username,
            'admin' => $request->admin ?? 0,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        $userPegawai->update([
            'id_jabatan' => $request->id_jabatan,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna Berhasil Di Perbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna Berhasil Di Hapus.');
    }
}
