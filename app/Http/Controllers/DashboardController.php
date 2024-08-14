<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPegawai;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\BobotKerja;
use App\Models\Pekerjaan;
use PDF;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $userCount = User::count();
        $jabatanCount = Jabatan::count();
        $kategoriCount = Kategori::count();
        $bobotkerjaCount = BobotKerja::count();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jabatanFilter = $request->input('jabatan_filter');

        $pekerjaans = Pekerjaan::query();
        if ($user->userPegawai && $user->userPegawai->jabatan) {
            $pekerjaans->where('id_user', $user->id);
        }
        if ($startDate) {
            $pekerjaans->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $pekerjaans->whereDate('updated_at', '<=', $endDate);
        }
        $pekerjaans = $pekerjaans->get();

        $pekerjaanByJabatan = Pekerjaan::query();
        if ($user->userPegawai && $user->userPegawai->jabatan) {
            switch ($user->userPegawai->jabatan->nama_jabatan) {
                case 'Senior Manager':
                    if ($jabatanFilter) {
                        $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) use ($jabatanFilter) {
                            $query->where('nama_jabatan', $jabatanFilter);
                        });
                    }
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with(['user.userPegawai', 'kategori', 'bobotKerja'])->get();
                    break;
                case 'SPV IT':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai IT');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with(['user.userPegawai', 'kategori', 'bobotKerja'])->get();
                    break;
                case 'Manager Sipil':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai Sipil');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with(['user.userPegawai', 'kategori', 'bobotKerja'])->get();
                    break;
                case 'Manager ME':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai ME');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with(['user.userPegawai', 'kategori', 'bobotKerja'])->get();
                    break;
            }
        }
        

        $filteredJabatans = Jabatan::whereIn('nama_jabatan', ['Pegawai IT', 'Pegawai Sipil', 'Pegawai ME'])->get();

        return view('dashboard.index', [
            'user' => $user,
            'userCount' => $userCount,
            'jabatanCount' => $jabatanCount,
            'kategoriCount' => $kategoriCount,
            'bobotkerjaCount' => $bobotkerjaCount,
            'pekerjaans' => $pekerjaans,
            'pekerjaanByJabatan' => $pekerjaanByJabatan,
            'jabatans' => $filteredJabatans,
        ]);
    }

    public function pdf(Request $request)
    {
        $user = Auth::user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jabatanFilter = $request->input('jabatan_filter');

        $pekerjaanByJabatan = Pekerjaan::query();
        if ($user->userPegawai && $user->userPegawai->jabatan) {
            switch ($user->userPegawai->jabatan->nama_jabatan) {
                case 'Senior Manager':
                    if ($jabatanFilter) {
                        $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) use ($jabatanFilter) {
                            $query->where('nama_jabatan', $jabatanFilter);
                        });
                    }
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with(['user', 'kategori', 'bobotKerja'])->get();
                    break;
                case 'SPV IT':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai IT');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with('user')->get();
                    break;
                case 'Manager Sipil':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai Sipil');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with('user')->get();
                    break;
                case 'Manager ME':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai ME');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with('user')->get();
                    break;
            }
        }

        foreach ($pekerjaanByJabatan as $pekerjaan) {
            if ($pekerjaan->foto_sebelum) {
                $path = storage_path('app/public/' . $pekerjaan->foto_sebelum);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $pekerjaan->foto_sebelum_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }

            if ($pekerjaan->foto_sesudah) {
                $path = storage_path('app/public/' . $pekerjaan->foto_sesudah);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $pekerjaan->foto_sesudah_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        }

        $pdf = PDF::loadView('dashboard.pdf', compact('pekerjaanByJabatan', 'startDate', 'endDate', 'jabatanFilter'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('laporan_pekerjaan.pdf');
    }

    
    public function print(Request $request)
    {
        $user = Auth::user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jabatanFilter = $request->input('jabatan_filter');
    
        $pekerjaanByJabatan = Pekerjaan::query();
        if ($user->userPegawai && $user->userPegawai->jabatan) {
            switch ($user->userPegawai->jabatan->nama_jabatan) {
                case 'Senior Manager':
                    if ($jabatanFilter) {
                        $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) use ($jabatanFilter) {
                            $query->where('nama_jabatan', $jabatanFilter);
                        });
                    }
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with(['user', 'kategori', 'bobotKerja'])->get();
                    break;
                case 'SPV IT':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai IT');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with('user')->get();
                    break;
                case 'Manager Sipil':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai Sipil');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with('user')->get();
                    break;
                case 'Manager ME':
                    $pekerjaanByJabatan->whereHas('user.userPegawai.jabatan', function ($query) {
                        $query->where('nama_jabatan', 'Pegawai ME');
                    });
                    if ($startDate) {
                        $pekerjaanByJabatan->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $pekerjaanByJabatan->whereDate('updated_at', '<=', $endDate);
                    }
                    $pekerjaanByJabatan = $pekerjaanByJabatan->with('user')->get();
                    break;
            }
        }
    
        return view('dashboard.print', compact('pekerjaanByJabatan', 'startDate', 'endDate', 'jabatanFilter'));
    }
    
}
