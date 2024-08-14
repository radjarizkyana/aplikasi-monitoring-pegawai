@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Form Tambah Pekerjaan</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul_pekerjaan">Judul Pekerjaan</label>
                                    <input type="text" name="judul_pekerjaan" id="judul_pekerjaan" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_kategori">Kategori </label>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }} ({{ $kategori->deskripsi }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_bobot_kerja">Bobot Kerja</label>
                                    <select name="id_bobot_kerja" id="id_bobot_kerja" class="form-control" required>
                                        @foreach($bobotKerjas as $bobotKerja)
                                            <option value="{{ $bobotKerja->id }}">{{ $bobotKerja->nama_bobot }} ({{ $bobotKerja->deskripsi }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="foto_sebelum">Foto Sebelum</label>
                                    <input type="file" name="foto_sebelum" id="foto_sebelum" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3">Tambah</button>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary px-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
