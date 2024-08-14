@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Bobot Kerja</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('bobotkerjas.update', $bobotKerja->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_bobot">Nama Bobot Kerja</label>
                            <input type="text" name="nama_bobot" class="form-control" value="{{ $bobotKerja->nama_bobot }}" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ $bobotKerja->deskripsi }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-3">Edit</button>
                        <a href="{{ route('bobotkerjas.index') }}" class="btn btn-secondary px-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
