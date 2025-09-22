@extends('index')
@section('content')
<div class="container-fluid">
	<div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>Kalender</h4>
        </div>
    </div>
    <div class="card mb-4 bg-opacity-10 border">
        <div class="card-body">
            <form action="{{ route('periodeKalender') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                <span class="badge rounded-circle me-1" style="width:10px; height:10px; background-color: #f87171;"></span>
                <span>Libur / Cuti</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge rounded-circle me-1" style="width:10px; height:10px; background-color: #34d399;"></span>
                <span>Terisi (<span id="jumlah-terisi">0</span>)</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge rounded-circle me-1" style="width:10px; height:10px; background-color: #facc15;"></span>
                <span>Belum Terisi (<span id="jumlah-belum">21</span>)</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahLog">
                    + Tambah Log
                </button>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCetakLog">
                    Cetak
                </button>
            </div>
        </div>
    </div>
    <table id="menus-table" class="table table-hover align-middle mb-0">
        <thead class="table-secondary text-center">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>SKP</th>
                <th>Link / Tautan</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody id="menus-tbody">
        </tbody>
    </table>
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
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="2025-09-22" required>
                        </div>
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
                                    <option selected>{{ $skp->skp }}</option>
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
@endif  
@endsection