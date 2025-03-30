@extends('index')
@section('content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <!-- Left: Profile Image -->
        <div class="col-lg-3 col-md-4 col-sm-6 text-center mb-4">
            <img src="{{ asset('assets/images/profile.jpg') }}" alt="Profile Picture" class="img-fluid mb-3">
        </div>

        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Detail Pegawai</h5>
	                    <div class="row mb-2">
	                        <div class="col-md-4 fw-bold">NIP:</div>
	                        <div class="col-md-8">{{ $pegawai->nip }}</div>
	                    </div>
	                    <div class="row mb-2">
	                        <div class="col-md-4 fw-bold">Nama:</div>
	                        <div class="col-md-8">{{ $pegawai->nama }}</div>
	                    </div>
	                    <div class="row mb-2">
	                        <div class="col-md-4 fw-bold">Tempat Lahir:</div>
	                        <div class="col-md-8">{{ $pegawai->tempat_lahir }}</div>
	                    </div>
	                    <div class="row mb-2">
	                        <div class="col-md-4 fw-bold">Tanggal Lahir:</div>
	                        <div class="col-md-8">{{ $pegawai->tanggal_lahir }}</div>
	                    </div>
	                    <div class="row mb-2">
	                        <div class="col-md-4 fw-bold">Jenis Kelamin Lahir:</div>
	                        <div class="col-md-8">{{ $pegawai->jenis_kelamin }}</div>
	                    </div>
	                    <div class="row mb-2">
	                        <div class="col-md-4 fw-bold">Status Kepegawaian:</div>
	                        <div class="col-md-8">{{ $pegawai->nama_kategori_kepegawaian }}</div>
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
@endsection