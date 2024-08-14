@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            <h2>Data Pengguna</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary px-3">Tambah Pegawai</a>
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary px-3">Kembali</a>
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->userPegawai->nama ?? 'N/A' }}</td>
                            <td>{{ $user->userPegawai->jabatan->nama_jabatan ?? 'Super Admin' }}</td>
                            <td>{{ $user->userPegawai->jenis_kelamin ?? 'N/A' }}</td>
                            <td>{{ $user->userPegawai->agama ?? 'N/A' }}</td>
                            <td>{{ $user->userPegawai->no_telp ?? 'N/A' }}</td>
                            <td>{{ $user->userPegawai->alamat ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Untuk Mengahapus Data Pengguna?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
