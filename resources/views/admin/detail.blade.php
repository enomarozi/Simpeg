@extends('index')
@section('content')
<style type="text/css">
    .card-title{
        padding: 20px;
    }
</style>
<div class="container-fluid mt-5">
    <div class="row justify-content-center">

        <div class="col-lg-3 col-md-4 col-sm-6 text-center mb-4 d-flex align-items-stretch">
            <div class="profile-image card shadow-sm w-100 h-100">
                <img src="{{ asset('assets/images/profile.jpg') }}" alt="Profile Picture" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="col-lg-5 col-md-8 col-sm-10">
            <div class="card shadow-sm mx-auto" style="max-width: 1000px; padding: 0px;">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4" style="font-size: 1.25rem;">Detail Pegawai</h5>
                    
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">NIP:</div>
                        <div class="col-7">{{ $pegawai->nip }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Nama:</div>
                        <div class="col-7">{{ $pegawai->gelar_depan }} {{ $pegawai->nama }}, {{ $pegawai->gelar_belakang }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Tempat Lahir:</div>
                        <div class="col-7">{{ $pegawai->tempat_lahir }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Tanggal Lahir:</div>
                        <div class="col-7">{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d-M-Y') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Agama:</div>
                        <div class="col-7">{{ $pegawai->agama }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Jenis Kelamin:</div>
                        <div class="col-7">{{ $pegawai->jenis_kelamin }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Status Kepegawaian:</div>
                        <div class="col-7">{{ $pegawai->nama_kategori_kepegawaian }} {{ $pegawai->nama_jenis_kepegawaian }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Fakultas:</div>
                        <div class="col-7">{{ $pegawai->nama_fakultas }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Departemen:</div>
                        <div class="col-7">{{ $pegawai->nama_departemen }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Pangkat:</div>
                        <div class="col-7">{{ $pegawai->pangkat }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Golongan:</div>
                        <div class="col-7">{{ $pegawai->golongan }}/a</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
