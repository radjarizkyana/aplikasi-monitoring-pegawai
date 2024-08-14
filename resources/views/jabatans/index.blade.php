@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            <h2>Data Jabatan</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('jabatans.create') }}" class="btn btn-primary">Tambah Jabatan</a>
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jabatans as $index => $jabatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jabatan->nama_jabatan }}</td>
                                <td>
                                    <a href="{{ route('jabatans.edit', $jabatan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('jabatans.destroy', $jabatan->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Untuk Mengahapus Data Jabatan')">Hapus</button>
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
