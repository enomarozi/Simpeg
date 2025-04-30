@extends('index')
@section('content')
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

    <!-- Tab Content -->
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
                          <input class="form-check-input" type="radio" name="gender" id="male" value="L" checked>
                          <label class="form-check-label" for="male">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="female" value="P">
                          <label class="form-check-label" for="female">Perempuan</label>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Agama</label>
                        <select class="form-select">
                            <option hidden>-- Pilih Agama --</option>
                            @foreach($agama as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status Perkawinan</label>
                        <select class="form-select">
                          <option hidden>-- Pilih Perkawinan --</option>
                            @foreach($perkawinan as $item)
                                <option value="{{ $item->id }}">{{ $item->status }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status Kewarganegaraan</label>
                        <select id='status_kewarganegaraan'class="form-select" onchange="KewarganegaraanSelect()">
                          <option hidden>-- Pilih Kewarganegaraan --</option>
                          @foreach($kewarganegaraan as $item)
                                <option value="{{ $item->id }}">{{ $item->kewarganegaraan }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3" id="negara" style="display:none;">
                        <label class="form-label">Kewarganegaraan</label>
                        <select class="form-select">
                          @foreach($negara as $item)
                                <option value="{{ $item->id }}">{{ $item->negara }}</option>
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
                        <textarea class="form-control"></textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kabupaten</label>
                        <select class="form-select">
                          <option>Kab. Dharmas Raya</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kecamatan</label>
                        <select class="form-select">
                          <option>Kec. Koto Salak</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" value="-">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. HP</label>
                        <input type="text" class="form-control" value="081374823635">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="ade.priyanto@lptik.unand.ac.id">
                      </div>
                    </div>
                  </div>
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
                        <select class="form-select">
                          <option hidden>-- Pilih Golongan Darah --</option>
                            @foreach($golonganDarah as $item)
                                <option value="{{ $item->id }}">{{ $item->golongan_darah }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" class="form-control" value="169">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="number" class="form-control" value="74">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Cacat</label>
                        <input type="text" class="form-control">
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
                        <input type="text" class="form-control" value="1310012501910002">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. NPWP</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">BPJS Tenaga Kerja</label>
                        <input type="text" class="form-control">
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
                        <select class="form-select">
                          <option>Bank Nagari</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">No. Rekening Bank</label>
                        <input type="text" class="form-control" value="12">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" value="Ade Priyanto">
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
            <h5 class="card-title">Unit Kerja</h5>
            <p>Nama Unit: -</p>
            <p>Alamat/Lokasi: -</p>
          </div>
        </div>
      </div>

      <!-- Pangkat Golongan Tab -->
      <div class="tab-pane fade" id="pangkat" role="tabpanel">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Pangkat Golongan</h5>
            <p>Pangkat: -</p>
            <p>Golongan: -</p>
          </div>
        </div>
      </div>

      <!-- Jabatan Tab -->
      <div class="tab-pane fade" id="jabatan" role="tabpanel">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Jabatan</h5>
            <p>Nama Jabatan: -</p>
            <p>Jenis Jabatan: -</p>
          </div>
        </div>
      </div>

      <!-- Pendidikan Tab -->
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



@endsection
