@extends('index')

@section('content')
<div class="container-fluid">
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>Matrix Peran Hasil</h4>
        </div>
    </div>
    <div class="card mb-4 bg-opacity-10 border">
        <div class="card-body">
            <form action="{{ route('periode') }}" method="GET">
                @csrf
                <div class="row align-items-end">
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
                    <div class="col-md-6">
                        <label for="unit_kerja" class="form-label fw-semibold">Unit Kerja</label>
                        <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" value="Universitas Andalas" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(!empty($periode))
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahIntervensiSKP">
                + Tambah SKP
            </button>
        </div>
    @endif
</div>

{{-- Modal Tambah Intervensi SKP --}}
<div class="modal fade" id="modalTambahIntervensiSKP" tabindex="-1" aria-labelledby="modalTambahIntervensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <form action="{{ route('intervensiAdd') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahIntervensiLabel">Tambah Intervensi SKP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="periode_id" id="periode_id_hidden" value="">                                 
                    <div class="mb-3">
                        <label for="skp_intervensi" class="form-label">SKP</label>
                        <select name="skp_intervensi" id="skp_intervensi" class="form-select" required>
                            <option value="" disabled selected>-- Pilih SKP diIntervensi --</option>
                                @foreach($daftarSkp as $item)
                                    <option value="{{ $item->id }}">
                 						{{ $item->skp }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bawahan_id" class="form-label">Bawahan</label>
                        <select name="bawahan_id" id="bawahan_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih SKP diIntervensi --</option>
                                @foreach($daftarBawahan as $item)
                                    <option value="{{ $item->id }}">
                 						{{ $item->nama }}
                                    </option>
                                @endforeach
                        </select>
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
</script>
@endsection