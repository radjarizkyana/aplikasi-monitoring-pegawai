<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPegawai;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\BobotKerja;
use App\Models\Pekerjaan;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userCount = User::count();
        $jabatanCount = Jabatan::count();
        $kategoriCount = Kategori::count();
        $bobotkerjaCount = BobotKerja::count();

        return view('dashboard.index', [
            'user' => $user,
            'userCount' => $userCount,
            'jabatanCount' => $jabatanCount,
            'kategoriCount' => $kategoriCount,
            'bobotkerjaCount' => $bobotkerjaCount,
            'pekerjaans' => $pekerjaans,
        ]);
    }

    public function dashboard()
    {
        $userCount = User::count();
        $jabatanCount = Jabatan::count();
        $kategoriCount = Kategori::count();
        $bobotkerjaCount = BobotKerja::count();

        return view('dashboard.index', compact('userCount', 'jabatanCount', 'kategoriCount', 'bobotkerjaCount'));
    }

    public function showUsers()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function showJabatans()
    {
        $jabatans = Jabatan::all();
        return view('jabatans.index', compact('jabatans'));
    }

    public function showKategoris()
    {
        $kategoris = Kategori::all();
        return view('kategoris.index', compact('kategoris'));
    }

    public function showBobotKerjas()
    {
        $bobotkerjas = BobotKerja::all();
        return view('bobotkerjas.index', compact('bobotkerjas'));
    }
}
