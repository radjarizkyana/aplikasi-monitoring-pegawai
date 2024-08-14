<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pekerjaan</title>
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin-bottom: 0;
            }
            body {
                margin: 1cm;
            }
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Pekerjaan - {{ Auth::user()->userPegawai->nama }}</h2>
    @if(!empty($startDate) && !empty($endDate) && !empty($jabatanFilter))
        <p>Berdasarkan Tanggal: {{ $startDate }} - {{ $endDate }}</p>
        <p>Berdasarkan Jabatan: {{ $jabatanFilter }}</p>   
     @elseif(!empty($startDate) && !empty($endDate))
        <p>Berdasarkan Tanggal: {{ $startDate }} - {{ $endDate }}</p>
     @elseif(!empty($jabatanFilter))
        <p>Berdasarkan Jabatan: {{ $jabatanFilter }}</p>   
    @endif
    <table>
        <thead>
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
                        <a href="{{ Storage::url($pekerjaan->foto_sesudah) }}"><img src="{{ Storage::url($pekerjaan->foto_sesudah) }}" alt="Foto Sesudah" width="110"></a>
                        @else
                        <p style="font-size: 13px; text-align:center; margin-top: 8px;">Pekerjaan <br> Belum Selesai</p>
                    @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
