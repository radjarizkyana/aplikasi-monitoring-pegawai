@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Data Bobot Kerja</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('bobotkerjas.create') }}" class="btn btn-primary">Tambah Bobot Kerja</a>
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Bobot</th>
                            <th>Deskripsi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bobotkerjas as $index => $bobotkerjas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bobotkerjas->nama_bobot }}</td>
                                <td>{{ $bobotkerjas->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('bobotkerjas.edit', $bobotkerjas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('bobotkerjas.destroy', $bobotkerjas->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Kamu Yakin Ingin Menghapus Data Bobot Kerja?')">Hapus</button>
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
