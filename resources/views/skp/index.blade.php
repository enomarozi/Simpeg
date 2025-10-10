@extends('index')
@section('content')
<div class="container-fluid">
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>Rencana SKP</h4>
        </div>
    </div>
    <div class="card mb-4 bg-opacity-10 border">
        <div class="card-body">
            <form action="{{ route('periodeSkp') }}" method="GET">
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
                <table class="table table-bordered align-middle mb-0">
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
                            <td>{{ $user->pegawai->atasan->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>NIP/NIKU</td>
                            <td>{{ $user->pegawai->nip ?? '-' }}</td>
                            <td>{{ $user->pegawai->atasan->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>{{ $user->pegawai->jabatan ?? '-' }}</td>
                            <td>{{ $user->pegawai->atasan->jabatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat</td>
                            <td>{{ $user->pegawai->pangkat ?? '-' }}</td>
                            <td>{{ $user->pegawai->atasan->pangkat ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td>Unit Kerja</td>
                            <td>{{ $user->pegawai->unit_kerja ?? '-' }}</td>
                            <td>{{ $user->pegawai->atasan->unit_kerja ?? '-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(!empty($periode))
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalTambahSKP">
                + Tambah SKP
            </button>
            <form action="{{ route('ajukanSKP', ['periode_id' => $periode]) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Ajukan SKP
                </button>
            </form>
        </div>
    @endif
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
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 40px;" class="text-center">No</th>
                            <th>Deskripsi SKP</th>
                            <th>Ukuran Keberhasilan / Indikator Kinerja Individu, dan Target</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Bagian A: Utama -->
                        <tr class="table-info fw-bold">
                            <td colspan="4">A. Utama</td>
                        </tr>
                        @php $no = 1;@endphp
                        @foreach($daftarSkp->where('jenis_skp', 1) as $skp)                    
                        <tr>
                            <td class="text-center align-top">{{ $no++ }}.</td>
                            <td class="align-top">
                                @if($skp->pelaksanaan_skp == 0)
                                    (Mandiri) | {{ $skp->skp }}
                                @elseif($skp->pelaksanaan_skp > 0)
                                    (Intervensi) | {{ $skp->skp }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <div class="mb-3">
                                        @php
                                            $status = $skp->status ?? 'draft';
                                            if ($status === 'disetujui') {
                                                $class = 'bg-success';    
                                            } elseif ($status === 'ditolak') {
                                                $class = 'bg-danger'; 
                                            } elseif ($status === 'diajukan') {
                                                $class = 'bg-primary';
                                            } else{
                                                $class = 'bg-warning';
                                            }
                                        @endphp
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="fw-semibold">Status :</span>
                                            <span class="badge {{ $class }} px-3 py-2">{{ $skp->status }}</span>
                                        </div>
                                    </div>
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
                            <td class="text-center align-top">
                                @if($skp->pelaksanaan_skp == 0)
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-primary me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditSkp" 
                                        data-skp-id="{{ $skp->id }}" 
                                        data-skp="{{ $skp->skp }}" 
                                        data-jenis-skp="{{ $skp->jenis_skp }}" 
                                        title="Edit SKP"> 
                                        <i class="bi bi-pencil-square"></i> 
                                    </button>
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalHapusSkp" 
                                        data-skp-id="{{ $skp->id }}" 
                                        data-skp="{{ $skp->skp }}"
                                        title="Hapus SKP">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        <!-- Bagian B: Tambahan -->
                        <tr class="table-info fw-bold">
                            <td colspan="4">B. Tambahan</td>
                        </tr>
                        @php $no = 1; @endphp
                        @foreach($daftarSkp->where('jenis_skp', 2) as $skp)
                        <tr>
                            <td class="text-center align-top">{{ $no++ }}.</td>
                            <td class="align-top">
                                @if($skp->pelaksanaan_skp == 0)
                                    (Mandiri) | {{ $skp->skp }}
                                @elseif($skp->pelaksanaan_skp > 0)
                                    (Intervensi) | {{ $skp->skp }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <div class="mb-3">
                                        @php
                                            $status = $skp->status ?? 'draft';
                                            if ($status === 'disetujui') {
                                                $class = 'bg-success';    
                                            } elseif ($status === 'ditolak') {
                                                $class = 'bg-danger'; 
                                            } elseif ($status === 'diajukan') {
                                                $class = 'bg-primary';
                                            } else{
                                                $class = 'bg-warning';
                                            }
                                        @endphp
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="fw-semibold">Status :</span>
                                            <span class="badge {{ $class }} px-3 py-2">{{ $skp->status }}</span>
                                        </div>
                                    </div>
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
                            <td class="text-center align-top">
                                @if($skp->pelaksanaan_skp == 0)
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-primary me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditSkp" 
                                        data-skp-id="{{ $skp->id }}" 
                                        data-skp="{{ $skp->skp }}" 
                                        data-jenis-skp="{{ $skp->jenis_skp }}" 
                                        title="Edit SKP"> 
                                        <i class="bi bi-pencil-square"></i> 
                                    </button>
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalHapusSkp" 
                                        data-skp-id="{{ $skp->id }}" 
                                        data-skp="{{ $skp->skp }}"
                                        title="Hapus SKP">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
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
@if(!empty($periode))
{{-- Modal Tambah SKP --}}
<div class="modal fade" id="modalTambahSKP" tabindex="-1" aria-labelledby="modalTambahSKPLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <form action="{{ route('skpAdd') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalTambahSKPLabel">Tambah SKP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="periode_id" id="periode_id_hidden" value="{{ $periode }}">
                    <div class="mb-3">
                        @if($user->hasRole('atasan'))
                            <label for="pelaksanaan_skp" class="form-label">SKP Atasan yang Diintervensi (Opsional)</label>
                        @elseif($user->hasRole('pegawai'))
                            <label for="pelaksanaan_skp" class="form-label">SKP Atasan yang Diintervensi</label>
                        @endif
                        <select name="pelaksanaan_skp" id="pelaksanaan_skp" class="form-select">
                            <option value="" disabled selected>-- Pilih SKP --</option>
                            @if($user->hasRole('atasan'))
                                <option value="0">Mandiri</option>
                            @endif
                            @foreach($daftarIntervensi as $item)
                                <option value="{{ $item->skp_id }}">
                                    Intervensi | {{ $item->skp->skp }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_skp" class="form-label">Jenis SKP</label>
                        <select name="jenis_skp" id="jenis_skp" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis --</option>
                            <option value="1">Utama</option>
                            <option value="2">Tambahan</option>
                        </select>
                    </div>
                    @if($user->hasRole('atasan'))
                    <div class="mb-3">
                        <label for="skp" id="skp-label" class="form-label">Sasaran Hasil Kerja</label>
                        <textarea name="skp" id="skp" class="form-control" rows="3"></textarea>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- Modal Edit SKP --}}
<div class="modal fade" id="modalEditSkp" tabindex="-1" aria-labelledby="modalEditSkpLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <form id="formEditSkp" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalEditSkpLabel">Edit SKP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_jenis_skp" class="form-label">Jenis SKP</label>
                        <select name="jenis_skp" id="edit_jenis_skp" class="form-select" required>
                            <option value="1">Utama</option>
                            <option value="2">Tambahan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_skp" class="form-label">Sasaran Hasil Kerja</label>
                        <textarea name="skp" id="edit_skp" class="form-control" rows="3" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- Modal Delete SKP --}}
<div class="modal fade" id="modalHapusSkp" tabindex="-1" aria-labelledby="modalHapusSkpLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <form id="formHapusSkp" method="POST">
        @csrf
        @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusSkpLabel">Konfirmasi Hapus SKP</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus SKP berikut?</p>
                        <div class="alert alert-secondary mb-0">
                            <strong id="namaSkp">SKP</strong>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- Modal Tambah Point SKP --}}
<div class="modal fade" id="modalTambahPoin" tabindex="-1" aria-labelledby="modalTambahPoinLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <div class="modal-content">
            <form id="formTambahPoin" action="{{ route('skpIndikatorAdd') }}" method="POST">
            @csrf
                <input type="hidden" name="skp_id" id="modalSkpId">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalTambahPoinLabel">Tambah Indikator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="indikator" class="form-label">Indikator</label>
                        <textarea name="indikator" id="indikator" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Point SKP --}}

<div class="modal fade" id="modalEditPoin" tabindex="-1" aria-labelledby="modalEditPoinLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <div class="modal-content">
            <form id="formEditPoin" action="{{ route('skpIndikatorEdit') }}"method="POST">
                @csrf
                <input type="hidden" name="skp_id" id="editSkpId">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalEditPoinLabel">Edit Indikator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <label for="indikatorSelectEdit" class="form-label">Pilih Indikator yang Akan Diedit</label>
                    <select name="indikator_id" id="indikatorSelectEdit" class="form-select" required>
                    </select>
                </div>
                <div class="modal-body">
                    <label for="indikator_update" class="form-label">Indikator</label>
                    <textarea name="indikator_update" id="indikator_update" class="form-control" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Delete Point SKP --}}

<div class="modal fade" id="modalHapusPoin" tabindex="-1" aria-labelledby="modalHapusPoinLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <div class="modal-content">
            <form id="formHapusPoin" action="{{ route('intervensiDelete') }}"method="POST">
                @csrf
                <input type="hidden" name="skp_id" id="hapusSkpId">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusPoinLabel">Hapus Indikator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="indikatorSelectDel" class="form-label">Pilih Indikator yang Akan Dihapus</label>
                        <select name="indikator_id" id="indikatorSelectDel" class="form-select" required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/skp.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const pelaksanaanSelect = document.getElementById("pelaksanaan_skp");
    const sasaranLabel = document.getElementById("skp-label");
    const sasaranField = document.getElementById("skp");

    function toggleSasaranField() {
        if (!sasaranField || !sasaranLabel) return; // Cegah error jika elemen tidak ada

        const selectedValue = pelaksanaanSelect.value;
        if (selectedValue === "0" || selectedValue === "") {
            sasaranField.style.display = "block";
            sasaranLabel.style.display = "block";
        } else {
            sasaranField.style.display = "none";
            sasaranLabel.style.display = "none";
        }
    }

    if (pelaksanaanSelect) {
        pelaksanaanSelect.addEventListener("change", toggleSasaranField);
        toggleSasaranField();
    }
});
</script>
@endif
@endsection
