@extends('index')

@section('content')
<div class="container-fluid mt-3">

    {{-- Dropdown Pilih Periode --}}
    <div class="mb-4">
        <label for="status_kepegawaian" class="form-label fw-semibold">Periode SKP</label>
        <select name="status_kepegawaian" id="status_kepegawaian" class="form-select">
            <option value="" disabled selected>-- Pilih Periode --</option>
            @foreach($SKPperiode as $periode)
                <option value="{{ $periode->id }}">
                    {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->translatedFormat('d-M-Y') }}
                    s/d
                    {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->translatedFormat('d-M-Y') }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Tabel Pegawai dan Atasan --}}
    <div class="table-responsive mb-4">
        <table class="table table-bordered align-middle">
            <thead class="table-secondary text-center">
                <tr>
                    <th>Informasi</th>
                    <th>Pegawai Yang Dinilai</th>
                    <th>Pejabat Penilai Kinerja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>{{ $pegawai->nama ?? '-' }}</td>
                    <td>{{ $atasan->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>{{ $pegawai->nip ?? '-' }}</td>
                    <td>{{ $atasan->nip ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>{{ $pegawai->jabatan ?? '-' }}</td>
                    <td>{{ $atasan->jabatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Pangkat</td>
                    <td>{{ $pegawai->pangkat ?? '-' }}</td>
                    <td>{{ $atasan->pangkat ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td>{{ $pegawai->unit_kerja ?? '-' }}</td>
                    <td>{{ $atasan->unit_kerja ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Tombol Tambah SKP --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-bold">Daftar SKP</h5>
        <a href="{{ route('skp.create') }}" class="btn btn-primary">+ Tambah SKP</a>
    </div>

</div>
@endsection
