@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Form Tambah Jabatan</h2>                
                </div>
                <div class="card-body">
                    <form action="{{ route('jabatans.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary px-3">Tambah</button>
                        <a href="{{ route('jabatans.index') }}" class="btn btn-secondary px-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
