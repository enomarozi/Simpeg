@extends('index')
@section('content')
<style type="text/css">
    .card-title{
        padding: 20px;
    }
</style>
<div class="container-fluid mt-3">
    <div class="row g-3">

        <!-- Gambar Profil -->
        <div class="col-lg-3 col-md-4 col-sm-12 text-center">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('assets/images/profile.jpg') }}" alt="Profile Picture"
                     class="img-fluid rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Detail Pegawai</h4>

                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">NIP:</div>
                        <div class="col-md-8">{{ $pegawai->nip }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Nama:</div>
                        <div class="col-md-8">{{ $pegawai->gelar_depan }} {{ $pegawai->nama }}, {{ $pegawai->gelar_belakang }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Tempat Lahir:</div>
                        <div class="col-md-8">{{ $pegawai->tempat_lahir }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Tanggal Lahir:</div>
                        <div class="col-md-8">{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d-M-Y') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Agama:</div>
                        <div class="col-md-8">{{ $pegawai->agama }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Jenis Kelamin:</div>
                        <div class="col-md-8">{{ $pegawai->jenis_kelamin }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Status Kepegawaian:</div>
                        <div class="col-md-8">{{ $pegawai->nama_kategori_kepegawaian }} {{ $pegawai->nama_jenis_kepegawaian }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Fakultas:</div>
                        <div class="col-md-8">{{ $pegawai->nama_fakultas }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Departemen:</div>
                        <div class="col-md-8">{{ $pegawai->nama_departemen }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Pangkat:</div>
                        <div class="col-md-8">{{ $pegawai->pangkat }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Golongan:</div>
                        <div class="col-md-8">{{ $pegawai->golongan }}/a</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Riwayat Pendidikan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Jenjang</th>
                                    <th>Nama Institusi</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada data pendidikan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
