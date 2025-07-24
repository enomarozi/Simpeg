@extends('index')
@section('content')
<div class="container-fluid">
	<div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>Evaluasi SKP</h4>
        </div>
    </div>
    <div class="card mb-4 bg-opacity-10 border">
        <div class="card-body">
            <form action="{{ route('periodeEvaluasi') }}" method="GET">
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
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Informasi</th>
                            <th>Pegawai Yang Dinilai</th>
                            <th>Pejabat Penilai Kinerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $user->pegawai->nama ?? '-' }}</td>
                            <td>{{ $atasanId->nama ?? ($user->pegawai->atasan->nama ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>NIP/NIKU</td>
                            <td>{{ $user->pegawai->nip ?? '-' }}</td>
                            <td>{{ $atasanId->nip ?? ($user->pegawai->atasan->nip ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>{{ $user->pegawai->jabatan ?? '-' }}</td>
                            <td>{{ $atasanId->jabatan ?? ($user->pegawai->atasan->jabatan ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat</td>
                            <td>{{ $user->pegawai->pangkat ?? '-' }}</td>
                            <td>{{ $atasanId->pangkat ?? ($user->pegawai->atasan->pangkat ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>Unit Kerja</td>
                            <td>{{ $user->pegawai->unit_kerja ?? '-' }}</td>
                            <td>{{ $atasanId->unit_kerja ?? ($user->pegawai->atasan->unit_kerja ?? '-') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
            @if(empty($daftarSkp))
                <div class="alert alert-light text-center fw-semibold border rounded shadow-sm py-3">
                    <i class="bi bi-exclamation-circle me-2 text-secondary"></i>
                    Periode belum dipilih. Silakan pilih periode SKP terlebih dahulu.
                </div>
            @elseif($daftarSkp->isEmpty()) 
                <div class="alert alert-light text-center fw-semibold border rounded shadow-sm py-3">
                    <i class="bi bi-exclamation-circle me-2 text-secondary"></i>
                    SKP untuk periode ini belum tersedia.
                </div>
            @else
                @php
                    $status = $skp->status ?? 'draft';
                    $class = $status === 'disetujui' ? 'bg-success' : 'bg-warning';
                @endphp
                <div class="mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-semibold">Status :</span>
                        <span class="badge {{ $class }} px-3 py-2">{{ $statusSkp }}</span>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 40px;" class="text-center">No</th>
                            <th>Deskripsi SKP</th>
                            <th>Ukuran Keberhasilan / Indikator Kinerja Individu, dan Target</th>
                            <th>Realisasi</th>
                            <th>Umpan Balik</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Bagian A: Utama -->
                        <tr class="table-info fw-bold">
                            <td colspan="6">A. Utama</td>
                        </tr>
                        @php $no = 1;@endphp
                        @foreach($daftarSkp->where('jenis_skp', 1) as $skp)  
                        @php
                            if($skp->pelaksanaan_skp == 1){
                                $skpText = $skp->skp;
                            } elseif($skp->pelaksanaan_skp > 1 && $skp->intervensi && $skp->intervensi->skp) {
                                $skpText = $skp->intervensi->skp->skp;
                            } else {
                                $skpText = 'SKP Atasan tidak ditemukan';
                            }
                        @endphp                      
                        <tr>
                            <td class="text-center align-top">{{ $no++ }}.</td>
                            <td class="align-top">
                                @if($skp->pelaksanaan_skp == 1)
                                    (Mandiri) | {{ $skpText }}
                                @elseif($skp->pelaksanaan_skp > 1)
                                    (Intervensi) | {{ $skpText }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <ul class="mb-0">
                                        @forelse($skp->indikatorList as $indikator)
                                            <li>{{ $indikator->indikator }}</li>
                                        @empty
                                            <li class="text-muted">Belum ada indikator.</li>
                                        @endforelse
                                    </ul>
                                    <div>
                                        <button class="btn btn-sm btn-outline-success btn-tambah-poin" data-skp-id="{{ $skp->id }}" title="Tambah Indikator">
                                            <i class="bi bi-plus-circle me-1"></i> Tambah
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-edit-indikator" data-bs-toggle="modal" data-bs-target="#modalEditPoin" data-skp-id="{{ $skp->id }}"> 
                                            <i class="bi bi-pencil-square me-1"></i> Edit 
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-indikator" data-bs-toggle="modal" data-bs-target="#modalHapusPoin" data-skp-id="{{ $skp->id }}"> 
                                            <i class="bi bi-trash3 me-1"></i> Hapus 
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                            	<button class="btn btn-sm btn-outline-success btn-tambah-poin" data-skp-id="{{ $skp->id }}" title="Tambah Indikator">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah
                                </button>
                            </td>
                            <td>
                            	<p>Umpan Balik</p>
                            </td>
                            <td class="text-center align-top">
                                @if($skp->pelaksanaan_skp == 1)
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-primary me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditSkp" 
                                        data-skp-id="{{ $skp->id }}" 
                                        data-skp="{{ $skpText }}" 
                                        data-jenis-skp="{{ $skp->jenis_skp }}" 
                                        title="Edit SKP"> 
                                        <i class="bi bi-pencil-square"></i> 
                                    </button>
                                @endif
                                <button type="button" 
                                    class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalHapusSkp" 
                                    data-skp-id="{{ $skp->id }}" 
                                    data-skp="{{ $skpText }}"
                                    title="Hapus SKP">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach

                        <!-- Bagian B: Tambahan -->
                        <tr class="table-info fw-bold">
                            <td colspan="6">B. Tambahan</td>
                        </tr>
                        @php $no = 1; @endphp
                        @foreach($daftarSkp->where('jenis_skp', 2) as $skp)
                        @php
                            if($skp->pelaksanaan_skp == 1){
                                $skpText = $skp->skp;
                            } elseif($skp->pelaksanaan_skp > 1 && $skp->intervensi && $skp->intervensi->skp) {
                                $skpText = $skp->intervensi->skp->skp;
                            } else {
                                $skpText = 'SKP Atasan tidak ditemukan';
                            }
                        @endphp 
                        <tr>
                            <td class="text-center align-top">{{ $no++ }}.</td>
                            <td class="align-top">
                                @if($skp->pelaksanaan_skp == 1)
                                    (Mandiri) | {{ $skpText }}
                                @elseif($skp->pelaksanaan_skp > 1)
                                    (Intervensi) | {{ $skpText }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <ul class="mb-0">
                                        @forelse($skp->indikatorList as $indikator)
                                            <li>{{ $indikator->indikator }}</li>
                                        @empty
                                            <li class="text-muted">Belum ada indikator.</li>
                                        @endforelse
                                    </ul>
                                    <div>
                                        <button class="btn btn-sm btn-outline-success btn-tambah-poin" data-skp-id="{{ $skp->id }}" title="Tambah Indikator">
                                            <i class="bi bi-plus-circle me-1"></i> Tambah
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-edit-indikator" data-bs-toggle="modal" data-bs-target="#modalEditPoin" data-skp-id="{{ $skp->id }}"> 
                                            <i class="bi bi-pencil-square me-1"></i> Edit 
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-indikator" data-bs-toggle="modal" data-bs-target="#modalHapusPoin" data-skp-id="{{ $skp->id }}" title="Hapus Indikator"> 
                                            <i class="bi bi-trash3 me-1"></i> Hapus 
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                            	<button class="btn btn-sm btn-outline-success btn-tambah-poin" data-skp-id="{{ $skp->id }}" title="Tambah Indikator">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah
                                </button>
                            </td>
                            <td>
                            	<p>Umpan Balik</p>
                            </td>
                            <td class="text-center align-top">
                                @if($skp->pelaksanaan_skp == 1)
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-primary me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditSkp" 
                                        data-skp-id="{{ $skp->id }}" 
                                        data-skp="{{ $skpText }}" 
                                        data-jenis-skp="{{ $skp->jenis_skp }}" 
                                        title="Edit SKP"> 
                                        <i class="bi bi-pencil-square"></i> 
                                    </button>
                                @endif
                                <button type="button" 
                                    class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalHapusSkp" 
                                    data-skp-id="{{ $skp->id }}" 
                                    data-skp="{{ $skpText }}"
                                    title="Hapus SKP">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif 
            </div>
        </div>
    </div>
</div>
@endsection