@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Form Selesaikan Pekerjaan</h2>
                    <form action="{{ route('pekerjaans.completeStore', $pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="foto_sesudah">Foto Sesudah</label>
                            <input type="file" name="foto_sesudah" id="foto_sesudah" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Selesaikan</button>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
