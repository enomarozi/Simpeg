@extends('index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">
    .card-title{
        padding: 20px;
    }
    .card-body.no-top-padding {
        padding-top: 0px;
    }
</style>
<div class="container-fluid mt-3">
    <div class="row g-3">

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
                    <input type="hidden" name="pegawai_id" value="{{ $pegawai->id }}">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">NIP:</div>
                        <div class="col-md-8">
                            <input type="text" name="nip" class="form-control" value="{{ $pegawai->nip ?? '' }}">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Nama:</div>
                        <div class="col-md-8">
                            <input type="text" name="gelar_depan" class="form-control d-inline w-auto" value="{{ $pegawai->gelar_depan ?? '' }}" placeholder="Gelar Depan">
                            <input type="text" name="nama" class="form-control d-inline w-auto" value="{{ $pegawai->nama ?? '' }}" placeholder="Nama Lengkap">
                            <input type="text" name="gelar_belakang" class="form-control d-inline w-auto" value="{{ $pegawai->gelar_belakang ?? '' }}" placeholder="Gelar Belakang">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Tempat Lahir:</div>
                        <div class="col-md-8">
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $pegawai->tempat_lahir ?? '' }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-4 fw-bold">Tanggal Lahir:</div>
                        <div class="col-md-8">
                            <input type="date" name="tanggal_lahir" class="form-control form-control-sm w-auto" value="{{ $pegawai->tanggal_lahir ? \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('Y-m-d') : '' }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-4 fw-bold">Status Kepegawaian:</div>
                        <div class="col-md-8">
                            <select name="status_kepegawaian" class="form-select">
                              <option value="" disabled selected>-- Pilih Status Kepegawaian --</option>
                                @foreach($kategoriPegawai as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $pegawai->kategori_kepegawaian_id ? 'selected' : ''}}>
                                    {{ $item->nama_kategori_kepegawaian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="fakultas-id" value="{{ $pegawai->fakultas_id }}">
                    <div class="row mb-2">
                        @if($pegawai->jabatan_id === 1)
                          <div class="col-md-4 fw-bold">Fakultas:</div>
                          <div class="col-md-8">
                            <select id="fakultasSelect" name="fakultas_id" class="form-control">
                              <option value="" disabled selected>-- Pilih Fakultas --</option>
                                @foreach($fakultas as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $pegawai->fakultas_id ? 'selected' : ''}}>
                                    {{ $item->nama_fakultas }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-start mt-3 px-3">
    <button type="button" class="btn btn-primary" id="submitBtn">
        <i class="bi bi-save"></i> Simpan Data
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPilihAtasan">
        <i class="bi-person-up"></i> Pilih Atasan
    </button>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif
    </script>

    <div class="modal fade" id="modalPilihAtasan" tabindex="-1" aria-labelledby="modalPilihAtasanLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('update_atasan') }}">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalPilihAtasanLabel">Pilih Atasan Langsung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="pegawai" value="{{ $pegawai->id }}">
                <label for="atasan_id" class="form-label">Nama Atasan</label>
                <select class="form-select" name="atasan_id" id="atasan_id" required>
                  <option value="">-- Pilih Atasan --</option>
                  @foreach($pegawai_as_atasan as $atasan)
                      <option value="{{ $atasan->id }}" {{ $atasan->id == $pegawai->atasan_id ? 'selected' : ''}}>
                          {{ $atasan->nama }}
                      </option>
                  @endforeach
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle"></i> Simpan Atasan</button>
              </div>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="container-fluid mt-3">
<div class="card mt-4">
  <div class="card-body no-top-padding">
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-3" id="profileTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#biodata" type="button" role="tab">Biodata Pribadi</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="unit-tab" data-bs-toggle="tab" data-bs-target="#unit" type="button" role="tab">Unit Kerja</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pangkat-tab" data-bs-toggle="tab" data-bs-target="#pangkat" type="button" role="tab">Pangkat Golongan</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="jabatan-tab" data-bs-toggle="tab" data-bs-target="#jabatan" type="button" role="tab">Jabatan</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" data-bs-target="#pendidikan" type="button" role="tab">Pendidikan</button>
      </li>
    </ul>

    <div class="tab-content" id="profileTabContent">
      <!-- Biodata Tab -->
      <div class="tab-pane fade show active" id="biodata" role="tabpanel">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="tab-pane fade show active" id="biodata" role="tabpanel">
              <div class="row">
                <!-- Kiri: Informasi Personal dan Alamat -->
                <div class="col-lg-6">
                  <!-- Informasi Personal -->
                  <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">
                      Informasi Personal
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="male" value="L"
                                 {{ $pegawai->jenis_kelamin == 'L' ? 'checked' : '' }}>
                          <label class="form-check-label" for="male">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="female" value="P"
                                 {{ $pegawai->jenis_kelamin == 'P' ? 'checked' : '' }}>
                          <label class="form-check-label" for="female">Perempuan</label>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-select">
                            <option value="" disabled selected>-- Pilih Agama --</option>
                            @foreach($agama as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $pegawai->agama_id ? 'selected' : '' }}>
                                  {{ $item->nama }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status Perkawinan</label>
                        <select name="perkawinan" class="form-select">
                          <option value="" disabled selected>-- Pilih Perkawinan --</option>
                            @foreach($perkawinan as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $pegawai->perkawinan_id ? 'selected' : ''}}>
                                  {{ $item->status }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status Kewarganegaraan</label>
                        <select name="status_kewarganegaraan" id='status_kewarganegaraan'class="form-select" onchange="KewarganegaraanSelect()">
                          <option value="" disabled selected>-- Pilih Kewarganegaraan --</option>
                          @foreach($kewarganegaraan as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $pegawai->kewarganegaraan_id ? 'selected' : ''}}>
                                  {{ $item->kewarganegaraan }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3" id="negara" style="display:none;">
                        <label name="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                        <select class="form-select">
                          @foreach($negara as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $pegawai->negara_id ? 'selected' : ''}}>
                                  {{ $item->negara }}</option>
                          @endforeach
                        </select>
                      </div>
                      <script type="text/javascript">
                        function KewarganegaraanSelect(){
                          const status = document.getElementById('status_kewarganegaraan').value;
                          const negara = document.getElementById('negara')
                          if(status == 2){
                            negara.style.display = "block";
                          }else{
                            negara.style.display = "none";
                          }

                        }
                      </script>
                      <div class="mb-3">
                        <label class="form-label">Usia Pensiun</label>
                        <input type="text" class="form-control" name="usia_pensiun">
                      </div>
                    </div>
                  </div>

                  <!-- Informasi Alamat -->
                  <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">
                      Informasi Alamat
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">Jalan</label>
                        <textarea name="alamat_lengkap" class="form-control"></textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Provinsi</label>
                        <select name="provinsi" class="form-select" id='provinsiSelect'>
                          <option value="" disabled selected>-- Pilih Provinsi --</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kota/Kabupaten</label>
                        <select name="kabupaten-kota" class="form-select" id='kotaSelect'>
                          <option value="" disabled selected>-- Pilih Kota/Kab --</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kecamatan</label>
                        <select name="kecamatan" class="form-select" id='kecamatanSelect'>
                          <option value="" disabled selected>-- Pilih Kecamatan --</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input name="telepon" type="text" class="form-control" value="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. HP</label>
                        <input name="hp" type="text" class="form-control" value="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" value="">
                      </div>
                    </div>
                  </div>
                  <script>
                    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                      .then(response=>response.json())
                      .then(provinces=>{
                        const selectElement = document.getElementById('provinsiSelect');
                        provinces.forEach(provinsi=>{
                          const option = document.createElement('option');
                          option.value = provinsi.id;
                          option.textContent = provinsi.name;
                          selectElement.appendChild(option);
                        });
                      })
                      .catch(error => console.error("Failed Provinces", error));

                      document.getElementById('provinsiSelect').addEventListener('change', function(){
                        const provinsiId = this.value;
                        const kotaSelect = document.getElementById('kotaSelect');
                        const kecamatanSelect = document.getElementById('kecamatanSelect');
                        kotaSelect.innerHTML = '<option selected disabled>-- Pilih Kota/Kab --</option>';
                        kecamatanSelect.innerHTML = '<option selected disabled>-- Pilih Kecamatan --</option>';
                        if(provinsiId){
                          fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
                            .then(response=>response.json())
                            .then(regencies=>{
                              const kotaSelect = document.getElementById('kotaSelect');
                              regencies.forEach(regency=>{
                                const option = document.createElement('option');
                                option.value = regency.id;
                                option.textContent = regency.name;
                                kotaSelect.appendChild(option);
                              });
                            })
                            .catch(error=>console.error('Failed Kota/Kab',error))
                        }
                      });

                      document.getElementById('kotaSelect').addEventListener('change', function(){
                        const kotaId = this.value;

                        const kecamatanSelect = document.getElementById('kecamatanSelect');
                        kecamatanSelect.innerHTML = '<option selected disabled>-- Pilih Kecamatan --</option>';
                        if(kotaId){
                          fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`)
                          .then(response => response.json())
                          .then(districts => {
                            districts.forEach(district=>{
                              const option = document.createElement('option');
                              option.value = district.id;
                              option.textContent = district.name;
                              kecamatanSelect.appendChild(option);
                            });
                          })
                          .catch(error=>console.error("Failed Kecamatan", error))

                        }

                      });
                  </script>
                </div>
                

                <!-- Kanan: Informasi Medis, ID, dan Bank -->
                <div class="col-lg-6">
                  <!-- Informasi Medis -->
                  <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">
                      Informasi Medis
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">Golongan Darah</label>
                        <select name="golongan_darah" class="form-select">
                          <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                            @foreach($golonganDarah as $item)
                                <option value="{{ $item->id }}">{{ $item->golongan_darah }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" class="form-control" name="tb">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="number" class="form-control" name="bb">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Cacat</label>
                        <input type="text" class="form-control" name="cacat">
                      </div>
                    </div>
                  </div>

                  <!-- Informasi ID -->
                  <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">
                      Informasi ID
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">No. KTP</label>
                        <input type="text" class="form-control" name="no_ktp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. NPWP</label>
                        <input type="text" class="form-control" name="no_npwp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">BPJS Tenaga Kerja</label>
                        <input type="text" class="form-control" name="no_bpjs">
                      </div>
                    </div>
                  </div>

                  <!-- Informasi Bank -->
                  <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">
                      Informasi Bank
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">Jenis Bank</label>
                        <select class="form-select" name="jenis_bank">
                          <option>Bank Nagari</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. Rekening Bank</label>
                        <input type="text" class="form-control" name="rekening">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" name="nama_penerima">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Unit Kerja Tab -->
      <div class="tab-pane fade" id="unit" role="tabpanel">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="card-header fw-bold">Informasi Unit Kerja</div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Unit Kerja</label>
                <select class="form-select" name="unit_kerja">
                  <option>Unit Kerja</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" name="tgl_masuk">
              </div>
            </div>
            <div class="card-header fw-bold">Informasi Keputusan</div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Diputuskan Oleh</label>
                <input type="text" class="form-control" name="diputuskan_oleh">
              </div>
              <div class="mb-3">
                <label class="form-label">No Surat</label>
                <input type="text" class="form-control" name="no_surat_u">
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal SK</label>
                <input type="date" class="form-control" name="tgl_sk">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pangkat Golongan Tab -->
      <div class="tab-pane fade" id="pangkat" role="tabpanel">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="card-header fw-bold">Informasi Pangkat Golongan</div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Pangkat Golongan</label>
                <select class="form-select" name="pangkat">
                  @foreach($kepangkatan as $item)
                  <option value="{{ $item->id }}" {{ $item->id == $pegawai->kepangkatan_id ? 'selected' : '' }}>
                    {{ $item->golongan }} - {{ $item->pangkat }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">TMT</label>
                <input type="date" class="form-control" name="tmt_pangkat" value="{{ $pegawai->tmt_pangkat ?? '' }}">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Jabatan Tab -->
      <div class="tab-pane fade" id="jabatan" role="tabpanel">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="row">
            <!-- Jabatan Fungsional -->
            <div class="col-md-6">
              <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">Informasi Jabatan Fungsional</div>
                <div class="card-body">
                  <div class="mb-3">
                    <label class="form-label">Jabatan Fungsional</label>
                    <select class="form-select" name='jabatan_f'>
                      <option value="" disabled selected>-- Pilih Jabatan --</option>
                        @foreach($jabatan as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $pegawai->jabatan_id ? 'selected' : ''}}>
                            {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">TMT</label>
                    <input type="date" class="form-control" name="tmt_jabatan_f">
                  </div>
                  <label class="form-label fw-bold mt-3">Keputusan</label>
                  <div class="mb-3">
                    <label class="form-label">Diputuskan Oleh</label>
                    <input type="text" class="form-control" name="diputuskan_jabatan_f">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">No. Surat</label>
                    <input type="text" class="form-control" name="no_surat_f">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tanggal SK</label>
                    <input type="date" class="form-control" name="tgl_sk_f">
                  </div>
                </div>
              </div>
            </div>

            <!-- Jabatan Struktural -->
            <div class="col-md-6">
              <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">Informasi Jabatan Struktural</div>
                <div class="card-body">
                  <div class="mb-3">
                    <label class="form-label">Jabatan Struktural</label>
                    <select class="form-select" name='jabatan_s'>
                      <option value="" disabled selected>-- PILIH --</option>
                      <!-- Tambahkan opsi jabatan struktural lain -->
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">TMT</label>
                    <input type="date" class="form-control" name="tmt_jabatan_s" placeholder="Pilih Tanggal">
                  </div>
                  <label class="form-label fw-bold mt-3">Keputusan</label>
                  <div class="mb-3">
                    <label class="form-label">Diputuskan Oleh</label>
                    <input type="text" class="form-control" name="diputuskan_jabatan_s">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">No. Surat</label>
                    <input type="text" class="form-control" name="no_surat_s">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tanggal SK</label>
                    <input type="date" class="form-control" name="tgl_sk_s" placeholder="Pilih Tanggal">
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Row -->
        </div>
      </div>
    </div>
      <div class="tab-pane fade" id="pendidikan" role="tabpanel">
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
  </div>
</div>
</div>
<script src="{{ asset('assets/js/requests.js') }}"></script>
@endsection
