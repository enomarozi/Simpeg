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
            <form action="{{ route('periodeIntervensi') }}" method="GET">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="status_kepegawaian" class="form-label fw-semibold">Periode SKP</label>
                        <select name="periode_id" id="status_kepegawaian" class="form-select" onchange="this.form.submit()" required>
                            <option value="" disabled {{ empty($periode) ? 'selected' : '' }}>-- Pilih Periode --</option>
                            @foreach($SKPPeriode as $item)
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
                + Tambah Intervensi
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
            @if(empty($daftarIntervensi))
                <div class="alert alert-light text-center fw-semibold border rounded shadow-sm py-3">
                    <i class="bi bi-exclamation-circle me-2 text-secondary"></i>
                    Periode belum dipilih. Silakan pilih periode SKP terlebih dahulu.
                </div>
            @elseif($daftarIntervensi->isEmpty()) 
            	<div class="alert alert-light text-center fw-semibold border rounded shadow-sm py-3">
                    <i class="bi bi-exclamation-circle me-2 text-secondary"></i>
                    Data intervensi untuk periode ini belum tersedia.
                </div>
            @else
          		<table class="table table-bordered table-striped">
				    <thead>
				        <tr>
				            <th>No</th>
				            <th>Pegawai</th>
				            <th>Isi SKP</th>
				            <th>Status</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				        @foreach($daftarIntervensi as $index => $intervensi)
					        <tr>
					            <td>{{ $index + 1 }}</td>
					            <td>{{ $intervensi->bawahan->nama ?? '-' }}</td>
					            <td>{{ $intervensi->skp->skp ?? '-' }}</td> {{-- isi SKP --}}
					            <td>
					                @php
					                    $statusClass = match($intervensi->status) {
					                        'diintervensi' => 'badge bg-warning',
					                        'diajukan' => 'badge bg-info',
					                        'diterima' => 'badge bg-success',
					                        'ditolak' => 'badge bg-danger',
					                        default => 'badge bg-secondary',
					                    };
					                @endphp
					                <span class="{{ $statusClass }}">{{ ucfirst($intervensi->status) }}</span>
					            </td>
					            <td>
								    <button 
								    	type="button" 
								    	class="btn btn-sm btn-danger" 
								    	data-bs-toggle="modal" 
								    	data-bs-target="#modalHapusIntervensi" 
								    	data-skp-id="{{ $intervensi->skp_id }}" 
								    	data-intervensi-id="{{ $intervensi->id }}" 
								    	data-nama="{{ $intervensi->bawahan->nama ?? '-' }}" 
								    	data-intervensi="{{ $intervensi->skp->skp ?? '-' }}">
								    	Hapus
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

{{-- Modal Tambah Intervensi SKP --}}
@if(!empty($periode))
	<div class="modal fade" id="modalTambahIntervensiSKP" tabindex="-1" aria-labelledby="modalTambahIntervensiLabel" aria-hidden="true">
	    <div class="modal-dialog modal-custom-width">
	        <form action="{{ route('intervensiAdd') }}" method="POST">
	            @csrf
	            <div class="modal-content">
	                <div class="modal-header bg-success text-white">
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
	<div class="modal fade" id="modalHapusIntervensi" tabindex="-1" aria-labelledby="modalHapusIntervensi" aria-hidden="true">
	    <div class="modal-dialog modal-custom-width">
	        <div class="modal-content">
	            <form id="formHapusPoin" action="{{ route('intervensiDelete') }}" method="POST">
	                @csrf
	                <input type="hidden" name="skp_id" id="hapusSkpId">
	                <input type="hidden" name="intervensi_id" id="hapusIntervensiId">
	                <div class="modal-header bg-danger text-white">
	                    <h5 class="modal-title" id="modalHapusIntervensi">Hapus Indikator</h5>
	                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
	                </div>
	                <div class="modal-body">
	                    <p id="pesanKonfirmasi" class="text-center fw-semibold text-danger"></p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
	                    <button type="submit" class="btn btn-danger">Hapus</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
@endif
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

        const modal = document.getElementById('modalHapusIntervensi');
	    modal.addEventListener('show.bs.modal', function (event) {
	        const button = event.relatedTarget;
	        const skpId = button.getAttribute('data-skp-id');
	        const intervensiId = button.getAttribute('data-intervensi-id');
	        const nama = button.getAttribute('data-nama');
	        const intervensi = button.getAttribute('data-intervensi');

	        modal.querySelector('#hapusSkpId').value = skpId;
	        modal.querySelector('#hapusIntervensiId').value = intervensiId;

	        const pesan = `Hapus intervensi <strong>${nama}</strong> (SKP: <em>${intervensi}</em>)?`
	        modal.querySelector('#pesanKonfirmasi').innerHTML = pesan;
	    });
    });
</script>
@endsection