@extends('index')

@section('content')
<div class="container-fluid mt-3">
    {{-- Card: Form Pilih Periode SKP dan Unit Kerja --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('periode') }}" method="GET">
                @csrf
                <div class="row align-items-end">
                    {{-- Dropdown Periode SKP --}}
                    <div class="col-md-6">
                        <label for="status_kepegawaian" class="form-label fw-semibold">Periode SKP</label>
                        <select name="periode_id" id="status_kepegawaian" class="form-select" onchange="this.form.submit()" required>
                            <option value="" disabled {{ empty($periode) ? 'selected' : '' }}>-- Pilih Periode --</option>
                            @foreach($SKPperiode as $item)
                                <option value="{{ $item->id }}">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d-M-Y') }}
                                    s/d
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d-M-Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Unit Kerja (readonly) --}}
                    <div class="col-md-6">
                        <label for="unit_kerja" class="form-label fw-semibold">Unit Kerja</label>
                        <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" value="Universitas Andalas" readonly>
                    </div>

                    {{-- Tombol Set --}}
                    <!-- <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Set</button>
                    </div> -->
                </div>
            </form>
        </div>
    </div>

    {{-- Card: Informasi Pegawai dan Atasan --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
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
                            <td>NIP/NIKU</td>
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
        </div>
    </div>

    {{-- Tombol Tambah SKP --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-bold">Daftar SKP</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSKP">
            + Tambah SKP
        </button>
    </div>

    {{-- Tabel: Daftar SKP --}}
    <div class="table-responsive">
    @if(!isset($daftarSkp))
        <div class="alert alert-light text-center fw-semibold border rounded shadow-sm py-3">
            <i class="bi bi-exclamation-circle me-2 text-secondary"></i>
            Periode belum dipilih. Silakan pilih periode SKP terlebih dahulu.
        </div>
    @else
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th colspan="5" class="text-start">HASIL KERJA</th>
                </tr>
            </thead>
            <tbody>
                <!-- Bagian A: Utama -->
                <tr class="table-info fw-bold">
                    <td colspan="5">A. Utama</td>
                </tr>
                @php $no = 1; @endphp
                @foreach($daftarSkp->where('jenis_skp', 1) as $skp)
                    <tr>
                        <td class="text-center align-top" style="width:40px;">{{ $no++ }}.</td>
                        <td colspan="3" class="py-2 fw-bold">
                            {{ $skp->intervensi_skp_id == 1 ? '(Mandiri)' : '(Intervensi)' }}
                            | {{ $skp->skp }}
                        </td>
                        <td class="text-center align-top" rowspan="2">
                            <button class="btn btn-sm btn-success"><i class="bi bi-star-fill"></i></button>
                            <button class="btn btn-sm btn-primary"><i class="bi bi-download"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td colspan="3" class="py-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong class="text-muted">
                                    Ukuran keberhasilan / Indikator Kinerja Individu, dan Target:
                                </strong>
                                <button class="btn btn-sm btn-outline-success btn-tambah-poin" data-skp-id="{{ $skp->id }}">
                                    <i class="bi bi-plus-circle"></i> Tambah Poin Indikator
                                </button>
                            </div>

                            <ul class="mb-0 mt-1">
                                @forelse($skp->indikatorList as $indikator)
                                    <li>{{ $indikator->indikator }}</li>
                                @empty
                                    <li class="text-muted">Belum ada indikator.</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-info fw-bold">
                    <td colspan="5">B. Tambahan</td>
                </tr>
                @php $no = 1; @endphp
                @foreach($daftarSkp->where('jenis_skp', 2) as $skp)
                    <tr>
                        <td class="text-center align-top" style="width:40px;">{{ $no++ }}.</td>
                        <td colspan="3" class="py-2 fw-bold">
                            {{ $skp->intervensi_skp_id == 1 ? '(Mandiri)' : '(Intervensi)' }}
                            | {{ $skp->skp }}
                        </td>
                        <td class="text-center align-top" rowspan="2">
                            <button class="btn btn-sm btn-success"><i class="bi bi-star-fill"></i></button>
                            <button class="btn btn-sm btn-primary"><i class="bi bi-download"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3" class="py-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong class="text-muted">
                                    Ukuran keberhasilan / Indikator Kinerja Individu, dan Target:
                                </strong>

                                <button class="btn btn-sm btn-outline-success btn-tambah-poin" data-skp-id="{{ $skp->id }}">
                                    <i class="bi bi-plus-circle"></i> Tambah Poin Indikator
                                </button>
                            </div>

                            <ul class="mb-0 mt-1">
                                @forelse($skp->indikatorList as $indikator)
                                    <li>{{ $indikator->indikator }}</li>
                                @empty
                                    <li class="text-muted">Belum ada indikator.</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif 
    </div>
</div>

{{-- Modal Tambah SKP --}}
<div class="modal fade" id="modalTambahSKP" tabindex="-1" aria-labelledby="modalTambahSKPLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <form action="{{ route('skpadd') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahSKPLabel">Tambah SKP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pegawai_id" value="{{ $pegawai->id }}">
                    <input type="hidden" name="atasan_id" value="{{ $pegawai->atasan_id }}">
                    <input type="hidden" name="periode_id" id="periode_id_hidden" value="">                                 
                    @if($user->hasRole('atasan'))
                    <div class="mb-3">
                        <label for="intervensi_skp_id" class="form-label">SKP Atasan yang Diintervensi (Opsional)</label>
                        <select name="intervensi_skp_id" id="intervensi_skp_id" class="form-select">
                            <option value="" disabled selected>-- Pilih SKP --</option>
                            <option value="1">Mandiri</option>
                        </select>
                    </div>
                    @elseif($user->hasRole('pegawai'))
                    <div class="mb-3">
                        <label for="intervensi_skp_id" class="form-label">SKP Atasan yang Diintervensi</label>
                        <select name="intervensi_skp_id" id="intervensi_skp_id" class="form-select">
                            <option value="" selected>-- Pilih SKP --</option>
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="jenis_skp" class="form-label">Jenis SKP</label>
                        <select name="jenis_skp" id="jenis_skp" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis --</option>
                            <option value="1">Utama</option>
                            <option value="2">Tambahan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="skp" class="form-label">Sasaran Hasil Kerja</label>
                        <textarea name="skp" id="skp" class="form-control" rows="3" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Modal Tambah Point SKP --}}
<div class="modal fade" id="modalTambahPoin" tabindex="-1" aria-labelledby="modalTambahPoinLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <div class="modal-content">
            <form id="formTambahPoin" action="{{ route('skpIndikator') }}" method="POST">
            @csrf
                <input type="hidden" name="skp_id" id="modalSkpId">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPoinLabel">Tambah Indikator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="skp" class="form-label">Indikator</label>
                        <textarea name="indikator" id="indikator" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const periodeSelect = document.getElementById('status_kepegawaian');
        const hiddenPeriodeInput = document.getElementById('periode_id_hidden');

        if (periodeSelect && hiddenPeriodeInput) {
            periodeSelect.addEventListener('change', function () {
                hiddenPeriodeInput.value = this.value;
            });

            hiddenPeriodeInput.value = periodeSelect.value;
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('modalTambahPoin');
        const modal = new bootstrap.Modal(modalElement);

        document.querySelectorAll('.btn-tambah-poin').forEach(button => {
            button.addEventListener('click', () => {
                const skpId = button.getAttribute('data-skp-id');
                document.getElementById('modalSkpId').value = skpId;
                modal.show();
            });
        });
    });
</script>
@endsection
