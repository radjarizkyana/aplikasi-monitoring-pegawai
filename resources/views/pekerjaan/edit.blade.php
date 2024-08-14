@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Pekerjaan</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('pekerjaans.update', $pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="judul_pekerjaan">Judul Pekerjaan</label>
                                    <input type="text" name="judul_pekerjaan" id="judul_pekerjaan" class="form-control" value="{{ $pekerjaan->judul_pekerjaan }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_kategori">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ $pekerjaan->id_kategori == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }} ({{ $kategori->deskripsi }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_bobot_kerja">Bobot Kerja</label>
                                    <select name="id_bobot_kerja" id="id_bobot_kerja" class="form-control" required>
                                        @foreach($bobotKerjas as $bobotKerja)
                                            <option value="{{ $bobotKerja->id }}" {{ $pekerjaan->id_bobot_kerja == $bobotKerja->id ? 'selected' : '' }}>{{ $bobotKerja->nama_bobot }} ({{ $bobotKerja->deskripsi }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="foto_sebelum">Foto Sebelum</label>
                                    <input type="file" name="foto_sebelum" id="foto_sebelum" class="form-control">
                                    <a href="{{ Storage::url($pekerjaan->foto_sebelum) }}"><img class="mt-2" src="{{ Storage::url($pekerjaan->foto_sebelum) }}" alt="Foto Sebelum" width="150"></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="foto_sesudah">Foto Sesudah</label>
                                    @if($pekerjaan->foto_sesudah)
                                        <input type="file" name="foto_sesudah" id="foto_sesudah" class="form-control">
                                        <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img class="mt-2" src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sesudah" width="150"></a>
                                    @else
                                        <input type="file" name="foto_sesudah" id="foto_sesudah" class="form-control">
                                        <p>Pekerjaan Belum Selesai</p>
                                    @endif</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 px-3">Edit</button>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary mt-3 px-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
