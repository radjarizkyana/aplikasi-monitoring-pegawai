@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Form Tambah Bobot Kerja</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('bobotkerjas.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_bobot">Nama Bobot Kerja</label>
                            <input type="text" name="nama_bobot" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('bobotkerjas.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
