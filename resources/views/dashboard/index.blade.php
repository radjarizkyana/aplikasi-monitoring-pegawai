@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            {{-- Login Admin --}}
            @if(Auth::user()->admin)
                <div class="row justify-content-center mt-5">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header" style="font-size: 20px;">Dashboard {{ Auth::user()->username }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card text-dark bg-light mb-3">
                                            <div class="card-header">Pengguna</div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $userCount }}</h5>
                                                <p class="card-text">Total jumlah dari pengguna</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-4 px-3">Tambah Pengguna</a>
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm mb-4 px-3">Lihat Pengguna</a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-dark bg-light mb-3">
                                            <div class="card-header">Jabatan</div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $jabatanCount }}</h5>
                                                <p class="card-text">Total jumlah dari jabatan</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('jabatans.create') }}" class="btn btn-primary btn-sm mb-4 px-3">Tambah Jabatan</a>
                                        <a href="{{ route('jabatans.index') }}" class="btn btn-secondary btn-sm mb-4 px-3">Lihat Jabatan</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card text-dark bg-light mb-3">
                                            <div class="card-header">Kategori</div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $kategoriCount }}</h5>
                                                <p class="card-text">Total jumlah dari kategori</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('kategoris.create') }}" class="btn btn-primary btn-sm mb-4 px-3">Tambah Kategori</a>
                                        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary btn-sm mb-4 px-3">Lihat Kategori</a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-dark bg-light mb-3">
                                            <div class="card-header">Bobot Kerja</div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $bobotkerjaCount }}</h5>
                                                <p class="card-text">Total jumlah dari bobot kerja</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('bobotkerjas.create') }}" class="btn btn-primary btn-sm mb-4 px-3">Tambah Bobot Kerja</a>
                                        <a href="{{ route('bobotkerjas.index') }}" class="btn btn-secondary btn-sm mb-4 px-3">Lihat Bobot Kerja</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Login Pegawai IT --}}
            @if(Auth::user()->userPegawai && Auth::user()->userPegawai->jabatan && Auth::user()->userPegawai->jabatan->nama_jabatan == 'Pegawai IT')
                <div class="card">
                    <div class="card-header" style="font-size: 20px;">Pekerjaan IT - {{ Auth::user()->userPegawai->nama }}</div>
                    <div class="card-body">
                        <a href="{{ route('pekerjaans.create') }}" class="btn btn-primary mb-3">Tambah Pekerjaan</a>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(isset($pekerjaans) && $pekerjaans->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pekerjaan</th>
                                            <th>Kategori</th>
                                            <th>Bobot Kerja</th>
                                            <th>Foto Sebelum</th>
                                            <th>Foto Sesudah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pekerjaans as $index => $pekerjaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pekerjaan->judul_pekerjaan }}</td>
                                                <td>{{ $pekerjaan->kategori->nama_kategori }}</td>
                                                <td>{{ $pekerjaan->bobotKerja->nama_bobot }}</td>
                                                <td><a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="100"></a></td>
                                                <td>
                                                    @if($pekerjaan->foto_sesudah)
                                                    <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sebelum" width="100"></a>
                                                    @else
                                                        <a href="{{ route('pekerjaans.complete', $pekerjaan->id) }}" class="btn btn-primary btn-sm mt-3">Selesaikan</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pekerjaans.edit', $pekerjaan->id) }}" class="btn btn-warning btn-sm mt-3">Edit</a>
                                                    <form action="{{ route('pekerjaans.destroy', $pekerjaan->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mt-3" onclick="return confirm('Anda Yakin Untuk Mengahapus Data Pekerjaan?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No pekerjaan available</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Login Pegawai Sipil --}}
            @if(Auth::user()->userPegawai && Auth::user()->userPegawai->jabatan && Auth::user()->userPegawai->jabatan->nama_jabatan == 'Pegawai Sipil')
                <div class="card">
                    <div class="card-header" style="font-size: 20px;">Pekerjaan Sipil - {{ Auth::user()->userPegawai->nama }}</div>
                    <div class="card-body">
                        <a href="{{ route('pekerjaans.create') }}" class="btn btn-primary mb-3">Tambah Pekerjaan</a>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(isset($pekerjaans) && $pekerjaans->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pekerjaan</th>
                                            <th>Kategori</th>
                                            <th>Bobot Kerja</th>
                                            <th>Foto Sebelum</th>
                                            <th>Foto Sesudah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pekerjaans as $index => $pekerjaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pekerjaan->judul_pekerjaan }}</td>
                                                <td>{{ $pekerjaan->kategori->nama_kategori }}</td>
                                                <td>{{ $pekerjaan->bobotKerja->nama_bobot }}</td>
                                                <td><a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="100"></a></td>
                                                <td>
                                                    @if($pekerjaan->foto_sesudah)
                                                    <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sebelum" width="100"></a>
                                                    @else
                                                        <a href="{{ route('pekerjaans.complete', $pekerjaan->id) }}" class="btn btn-primary btn-sm mt-3">Selesaikan</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pekerjaans.edit', $pekerjaan->id) }}" class="btn btn-warning btn-sm mt-3">Edit</a>
                                                    <form action="{{ route('pekerjaans.destroy', $pekerjaan->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mt-3" onclick="return confirm('Anda Yakin Untuk Mengahapus Data Pekerjaan?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No pekerjaan available</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Login Pegawai ME --}}
            @if(Auth::user()->userPegawai && Auth::user()->userPegawai->jabatan && Auth::user()->userPegawai->jabatan->nama_jabatan == 'Pegawai ME')
                <div class="card">
                    <div class="card-header" style="font-size: 20px;">Pekerjaan ME - {{ Auth::user()->userPegawai->nama }}</div>
                    <div class="card-body">
                        <a href="{{ route('pekerjaans.create') }}" class="btn btn-primary mb-3">Tambah Pekerjaan</a>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(isset($pekerjaans) && $pekerjaans->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pekerjaan</th>
                                            <th>Kategori</th>
                                            <th>Bobot Kerja</th>
                                            <th>Foto Sebelum</th>
                                            <th>Foto Sesudah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pekerjaans as $index => $pekerjaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pekerjaan->judul_pekerjaan }}</td>
                                                <td>{{ $pekerjaan->kategori->nama_kategori }}</td>
                                                <td>{{ $pekerjaan->bobotKerja->nama_bobot }}</td>
                                                <td><a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="100"></a></td>
                                                <td>
                                                    @if($pekerjaan->foto_sesudah)
                                                    <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sebelum" width="100"></a>
                                                    @else
                                                        <a href="{{ route('pekerjaans.complete', $pekerjaan->id) }}" class="btn btn-primary btn-sm mt-3">Selesaikan</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pekerjaans.edit', $pekerjaan->id) }}" class="btn btn-warning btn-sm mt-3">Edit</a>
                                                    <form action="{{ route('pekerjaans.destroy', $pekerjaan->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mt-3" onclick="return confirm('Anda Yakin Untuk Mengahapus Data Pekerjaan?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No pekerjaan available</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Login SPV IT --}}
            @if(Auth::user()->userPegawai && Auth::user()->userPegawai->jabatan && Auth::user()->userPegawai->jabatan->nama_jabatan == 'SPV IT')
                <div class="card">
                    <div class="card-header">
                        <h3>Data Pekerjaan Pegawai IT - {{ Auth::user()->userPegawai->nama }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.index') }}" method="GET" class="form-inline">
                            <div class="form-group">
                                <label for="start_date" class="mr-2">Tanggal Mulai:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="ml-3 mr-2">Tanggal Akhir:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <button id="filterButton" class="btn btn-primary px-3">Urutkan</button>
                        </form>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('dashboard.print') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-default px-3 mr-2">Cetak</button>
                                </form>
                                <form method="GET" action="{{ route('dashboard.pdf') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-danger px-3">Unduh PDF</button>
                                </form>
                            </div>
                        </div>
                        
                        @if($pekerjaanByJabatan->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>                                            
                                            <th>Nama Pekerjaan</th>
                                            <th>Kategori</th>
                                            <th>Bobot Kerja</th>
                                            <th>Foto Sebelum</th>
                                            <th>Foto Sesudah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pekerjaanByJabatan as $index => $pekerjaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pekerjaan->user->userPegawai->nama ?? 'N/A' }}</td>
                                                <td>{{ $pekerjaan->judul_pekerjaan }}</td>
                                                <td>{{ $pekerjaan->kategori->nama_kategori }}</td>
                                                <td>{{ $pekerjaan->bobotKerja->nama_bobot }}</td>
                                                <td><a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="110"></a></td>
                                                <td>
                                                @if($pekerjaan->foto_sesudah)
                                                    <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sebelum" width="110"></a>
                                                    @else
                                                    <p style="font-size: 13px; text-align:center; margin-top: 8px;">Pekerjaan <br> Belum Selesai</p>
                                                @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('pekerjaans.destroy', $pekerjaan->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Tidak ada pekerjaan yang ditemukan.</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Login Manager Sipil --}}
            @if(Auth::user()->userPegawai && Auth::user()->userPegawai->jabatan && Auth::user()->userPegawai->jabatan->nama_jabatan == 'Manager Sipil')
                <div class="card">
                    <div class="card-header">
                        <h3>Data Pekerjaan Pegawai Sipi - {{ Auth::user()->userPegawai->nama }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.index') }}" method="GET" class="form-inline">
                            <div class="form-group">
                                <label for="start_date" class="mr-2">Tanggal Mulai:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="ml-3 mr-2">Tanggal Akhir:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <button id="filterButton" class="btn btn-primary px-3">Urutkan</button>
                        </form>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('dashboard.print') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-default px-3 mr-2">Cetak</button>
                                </form>
                                <form method="GET" action="{{ route('dashboard.pdf') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-danger px-3">Unduh PDF</button>
                                </form>
                            </div>
                        </div>

                        @if($pekerjaanByJabatan->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Nama Pekerjaan</th>
                                            <th>Kategori</th>
                                            <th>Bobot Kerja</th>
                                            <th>Foto Sebelum</th>
                                            <th>Foto Sesudah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pekerjaanByJabatan as $index => $pekerjaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pekerjaan->user->userPegawai->nama ?? 'N/A' }}</td>
                                                <td>{{ $pekerjaan->judul_pekerjaan }}</td>
                                                <td>{{ $pekerjaan->kategori->nama_kategori }}</td>
                                                <td>{{ $pekerjaan->bobotKerja->nama_bobot }}</td>
                                                <td><a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="110"></a></td>
                                                <td>
                                                @if($pekerjaan->foto_sesudah)
                                                    <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sebelum" width="110"></a>
                                                    @else
                                                    <p style="font-size: 13px; text-align:center; margin-top: 8px;">Pekerjaan <br> Belum Selesai</p>
                                                @endif</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('pekerjaans.destroy', $pekerjaan->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Tidak ada pekerjaan yang ditemukan.</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Login Manager ME --}}
            @if(Auth::user()->userPegawai && Auth::user()->userPegawai->jabatan && Auth::user()->userPegawai->jabatan->nama_jabatan == 'Manager ME')
                <div class="card">
                    <div class="card-header">
                        <h3>Data Pekerjaan Pegawai ME - {{ Auth::user()->userPegawai->nama }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.index') }}" method="GET" class="form-inline">
                            <div class="form-group">
                                <label for="start_date" class="mr-2">Tanggal Mulai:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="ml-3 mr-2">Tanggal Akhir:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <button id="filterButton" class="btn btn-primary px-3">Urutkan</button>
                        </form>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('dashboard.print') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-default px-3 mr-2">Cetak</button>
                                </form>
                                <form method="GET" action="{{ route('dashboard.pdf') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-danger px-3">Unduh PDF</button>
                                </form>
                            </div>
                        </div>

                        @if($pekerjaanByJabatan->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Nama Pekerjaan</th>
                                            <th>Kategori</th>
                                            <th>Bobot Kerja</th>
                                            <th>Foto Sebelum</th>
                                            <th>Foto Sesudah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pekerjaanByJabatan as $index => $pekerjaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pekerjaan->user->userPegawai->nama ?? 'N/A' }}</td>
                                                <td>{{ $pekerjaan->judul_pekerjaan }}</td>
                                                <td>{{ $pekerjaan->kategori->nama_kategori }}</td>
                                                <td>{{ $pekerjaan->bobotKerja->nama_bobot }}</td>
                                                <td><a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="110"></a></td>
                                                <td>
                                                @if($pekerjaan->foto_sesudah)
                                                    <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sebelum" width="110"></a>
                                                    @else
                                                    <p style="font-size: 13px; text-align:center; margin-top: 8px;">Pekerjaan <br> Belum Selesai</p>
                                                @endif</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('pekerjaans.destroy', $pekerjaan->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Tidak ada pekerjaan yang ditemukan.</p>
                        @endif
                    </div>
                </div>
            @endif
            
            {{-- Login Senior Manager --}}
            @if(Auth::user()->userPegawai && Auth::user()->userPegawai->jabatan && Auth::user()->userPegawai->jabatan->nama_jabatan == 'Senior Manager')
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-2">Data Pekerjaan dari Semua Divisi - {{ Auth::user()->userPegawai->nama }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.index') }}" method="GET" class="form-inline">
                            <div class="form-group">
                                <label for="start_date" class="mr-2">Tanggal Mulai:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="ml-3 mr-2">Tanggal Akhir:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="jabatan_filter" class="ml-3 mr-2">Jabatan:</label>
                                <select class="form-control" id="jabatan_filter" name="jabatan_filter">
                                    <option value="">All</option>
                                    @foreach($jabatans as $jabatan)
                                        <option value="{{ $jabatan->nama_jabatan }}" {{ request('jabatan_filter') == $jabatan->nama_jabatan ? 'selected' : '' }}>
                                            {{ $jabatan->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button id="filterButton" class="btn btn-primary px-3">Urutkan</button>
                        </form>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('dashboard.print') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-default px-3 mr-2">Cetak</button>
                                </form>
                                <form method="GET" action="{{ route('dashboard.pdf') }}" target="_blank" class="d-inline">
                                    <input type="hidden" name="start_date" value="{{ request()->input('start_date') }}">
                                    <input type="hidden" name="end_date" value="{{ request()->input('end_date') }}">
                                    <input type="hidden" name="jabatan_filter" value="{{ request()->input('jabatan_filter') }}">
                                    <button type="submit" class="btn btn-danger px-3">Unduh PDF</button>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Bobot Kerja</th>
                                        <th>Foto Sebelum</th>
                                        <th>Foto Sesudah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pekerjaanByJabatan as $index => $pekerjaan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pekerjaan->user->userPegawai->nama ?? 'N/A' }}</td>
                                            <td>{{ $pekerjaan->user->userPegawai->jabatan->nama_jabatan}}</td>
                                            <td>{{ $pekerjaan->judul_pekerjaan }}</td>
                                            <td>{{ $pekerjaan->kategori->nama_kategori }}</td>
                                            <td>{{ $pekerjaan->bobotKerja->nama_bobot }}</td>
                                            <td><a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="110"></a></td>
                                            <td>
                                            @if($pekerjaan->foto_sesudah)
                                                <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sebelum" width="110"></a>
                                                @else
                                                <p style="font-size: 13px; text-align:center; margin-top: 8px;">Pekerjaan <br> Belum Selesai</p>
                                            @endif
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
