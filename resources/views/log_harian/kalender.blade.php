@extends('index')
@section('content')
<div class="container-fluid">
	<div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>{{ $title }}</h4>
        </div>
    </div>
    <div class="card mb-4 bg-opacity-10 border">
        <div class="card-body">
            <form action="{{ route('periodeKalender') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="periode_id" class="form-label fw-semibold">Periode SKP</label>
                        <select name="periode_id" id="periode_id" class="form-select" onchange="this.form.submit()" required>
                            <option value="" disabled {{ empty($periode ?? null) ? 'selected' : '' }}>-- Pilih Periode --</option>
                            @foreach($SKPPeriode as $item)
                                <option value="{{ $item->id }}" {{ ($periode ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d-M-Y') }}
                                    s/d
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d-M-Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="periode_id" class="form-label fw-semibold">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" onchange="this.form.submit()" required>
                            <option value="" disabled {{ empty($bulan ?? null) ? 'selected' : '' }}>-- Pilih Bulan --</option>
                            <option value="1" {{ $bulan == 1 ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ $bulan == 2 ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ $bulan == 3 ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ $bulan == 4 ? 'selected' : '' }}>April</option>
                            <option value="5" {{ $bulan == 5 ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ $bulan == 6 ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ $bulan == 7 ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ $bulan == 8 ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ $bulan == 9 ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $bulan == 10 ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $bulan == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $bulan == 12 ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="unit_kerja" class="form-label fw-semibold">Unit Kerja</label>
                        <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" value="Universitas Andalas" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm mb-3">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center">
                <span class="badge rounded-circle me-1" style="width:10px; height:10px; background-color: #34d399;"></span>
                <span>Terisi (<span id="jumlah-terisi">{{ $terisi }}</span>)</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge rounded-circle me-1" style="width:10px; height:10px; background-color: #facc15;"></span>
                <span>Belum Terisi (<span id="jumlah-belum">{{ $belum_terisi }}</span>)</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahLog">
                    + Tambah Log
                </button>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCetakLog">
                    Cetak
                </button>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
            <table id="menus-table" class="table table-hover align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Aktivitas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($logHarian))
                @foreach($logHarian as $index => $log)
                    <tr>
                        <td class="text-center align-top">{{ $index + 1 }}</td>
                        <td class="text-center align-top">{{ $log->tanggal }}</td>
                        <td class="text-center align-top">{{ $log->nama_aktivitas }}</td>
                        <td class="text-center align-top">
                            <div>
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-success btn-detail-log" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modelDetailLog" 
                                    data-id="{{ $log->id }}"
                                    data-pegawai_id="{{ $log->pegawai->nama }} "
                                    data-tanggal="{{ $log->tanggal }}"
                                    data-nama_aktivitas="{{ $log->nama_aktivitas }}"
                                    data-deskripsi="{{ $log->deskripsi }}"
                                    data-skp="{{ $log->skpRelasi->skp }}"
                                    data-link="{{ $log->link }}"> 
                                    <i class="bi bi-pencil-square me-1"></i> Detail 
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-primary btn-edit-log" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modelEditLog" 
                                    data-edit_id="{{ $log->id }}"
                                    data-edit_tanggal="{{ $log->tanggal }}"
                                    data-edit_nama_aktivitas="{{ $log->nama_aktivitas }}"
                                    data-edit_deskripsi="{{ $log->deskripsi }}"
                                    data-edit_skp="{{ $log->skpRelasi->id }}"
                                    data-edit_link="{{ $log->link }}"> 
                                    <i class="bi bi-pencil-square me-1"></i> Edit > 
                                </button>
                                <button 
                                    type="button"
                                    class="btn btn-sm btn-outline-danger btn-hapus-log" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modelHapusLog" 
                                    data-hapus_id="{{ $log->id }}"
                                    data-hapus_tanggal="{{ $log->tanggal }}"> 
                                    <i class="bi bi-trash3 me-1"></i> Hapus 
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@if(!empty($periode))
{{-- Modal Tambah Log --}}
<div class="modal fade" id="modalTambahLog" tabindex="-1" aria-labelledby="modalTambahSKPLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width-lx">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSKPLabel">Tambah Log Harian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form action="{{ route('kalenderAdd') }}" method="POST">
                @csrf
                <input type="hidden" name="periode_id" id="periode_id_hidden" value="{{ $periode }}">
                <fieldset class="mb-3">
                    <legend class="fs-6 fw-bold">Aktivitas (Wajib Diisi)</legend>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <script>
                        const today = new Date().toISOString().split('T')[0];
                        document.getElementById('tanggal').value = today;
                    </script>
                    <div class="mb-3">
                        <label for="namaAktivitas" class="form-label">Nama Aktivitas</label>
                        <input type="text" class="form-control" id="namaAktivitas" name="nama_aktivitas" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" minlength="10" required></textarea>
                    <div class="form-text">Deskripsi minimal 10 karakter.</div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="fs-6 fw-bold">Tautan SKP & Output (Opsional)</legend>
                    <div class="mb-3">
                        <label for="skp" class="form-label">SKP</label>
                        <select class="form-select" id="skp" name="skp">
                            <option selected>- Silakan Pilih -</option>
                            @foreach($daftarSkp as $skp)  
                                <option value="{{ $skp->id }}">{{ $skp->skp }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link / Tautan</label>
                        <input type="url" class="form-control" id="link" name="link">
                    </div>
                </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- Modal Detail Log --}}
<div class="modal fade" id="modelDetailLog" tabindex="-1" aria-labelledby="modalDetailLogLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width-lx">
        <div class="modal-content border border-success rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLogLabel">Detail Log Aktivitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="modal-pegawai_id" class="form-label">Pegawai</label>
                    <input type="text" class="form-control" id="modal-pegawai_id" readonly>
                </div>
                <div class="mb-3">
                    <label for="modal-tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="modal-tanggal" readonly>
                </div>
                <div class="mb-3">
                    <label for="modal-nama_aktivitas" class="form-label">Nama Aktivitas</label>
                    <input type="text" class="form-control" id="modal-nama_aktivitas" readonly>
                </div>
                <div class="mb-3">
                    <label for="modal-deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="modal-deskripsi" rows="3" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label for="modal-skp" class="form-label">SKP</label>
                    <input type="text" class="form-control" id="modal-skp" readonly>
                </div>
                <div class="mb-3">
                    <label for="modal-link" class="form-label">Link</label>
                    <input type="url" class="form-control" id="modal-link" readonly>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal Edit Log --}}
<div class="modal fade" id="modelEditLog" tabindex="-1" aria-labelledby="modalEditLogLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width-lx">
        <div class="modal-content border border-success rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLogLabel">Detail Edit Aktivitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kalenderEdit') }}" method="POST">
                @csrf
                    <input type="hidden" class="form-control" name="periode_id" value="{{ $periode }}">
                    <input type="hidden" class="form-control" id="modal_edit_id" name="id">
                    <div class="mb-3">
                        <label for="modal-edit_nama_aktivitas" class="form-label">Nama Aktivitas</label>
                        <input type="text" class="form-control" id="modal-edit_nama_aktivitas" name="nama_aktivitas">
                    </div>
                    <div class="mb-3">
                        <label for="modal-edit_deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="modal-edit_deskripsi" rows="3" name="deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="modal-edit_skp" class="form-label">SKP</label>
                        <select class="form-select" id="modal-edit_skp" name="skp">
                            <option selected>- Silakan Pilih -</option>
                            @foreach($daftarSkp as $skp)  
                                <option value="{{ $skp->id }}">{{ $skp->skp }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modal-edit_link" class="form-label">Link</label>
                        <input type="url" class="form-control" id="modal-edit_link" name="link">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal Delete Point SKP --}}
<div class="modal fade" id="modelHapusLog" tabindex="-1" aria-labelledby="modalHapusLogLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <div class="modal-content">
            <form id="formHapusPoin" action="{{ route('kalenderHapus') }}"method="POST">
                @csrf
                <input type="hidden" class="form-control" id="modal_hapus_id" name="id">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusLogLabel">Hapus Log Harian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <p id="modal-hapus_tanggal" class="mb-0 px-3 py-2 rounded text-center small"></p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/kalender.js') }}"></script>
@endif
@endsection