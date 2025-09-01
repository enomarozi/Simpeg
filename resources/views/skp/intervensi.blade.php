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
					                    $status = $intervensi->status;
					                    $statusClass = match($status) {
					                        'draft' => 'badge bg-warning',
					                        'disetujui' => 'badge bg-success',
					                        'ditolak' => 'badge bg-danger',
					                    };
					                @endphp
					                <span class="{{ $statusClass }}">{{ ucfirst($status) }}</span>
					            </td>
					            <td>
					            	<button 
								    	type="button" 
								    	class="btn btn-sm btn-primary btn-indikator" 
								    	data-skp-id="{{ $intervensi->skp_id }}" 
								    	data-intervensi-id="{{ $intervensi->id }}" 
								    	data-nama="{{ $intervensi->bawahan->nama ?? '-' }}" 
								    	data-pegawai-id="{{ $intervensi->bawahan->id ?? '-' }}" 
								    	data-intervensi="{{ $intervensi->skp->skp ?? '-' }}">
								    	Indikator
									</button>
								    <button 
								    	type="button" 
								    	class="btn btn-sm btn-danger" 
								    	data-bs-toggle="modal" 
								    	data-bs-target="#modalHapusIntervensi" 
								    	data-skp-id="{{ $intervensi->skp_id }}" 
								    	data-intervensi-id="{{ $intervensi->id }}" 
								    	data-nama="{{ $intervensi->bawahan->nama ?? '-' }}"
								    	data-pegawai-id="{{ $intervensi->bawahan->id ?? '-' }}" 
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


@if(!empty($periode))
	{{-- Modal Tambah Intervensi SKP --}}
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
									        {{ $item->skp ?? $item->skp_display }}
									    </option>
									@endforeach
	                        </select>
	                    </div>
	                    <div class="mb-3">
	                        <label for="bawahan_id" class="form-label">Bawahan</label>
	                        <select name="bawahan_id" id="bawahan_id" class="form-select" required>
	                            <option value="" disabled selected>-- Pilih Bawahan --</option>
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
	{{-- Modal Indikator Intervensi SKP --}}
	<div class="modal fade" id="modalIndikatorIntervensi" tabindex="-1" aria-labelledby="modalIndikatorIntervensi" aria-hidden="true">
	    <div class="modal-dialog modal-custom-width">
	        <div class="modal-content">
	            <form id="formIndikatorPoin" action="{{ route('intervensiSetuju') }}" method="POST">
	                @csrf
	                <input type="hidden" name="skp_setuju" id="skpIdIndikator">
	                <input type="hidden" name="skpIndikator_setuju" id="intervensiIdIndikator">
	                <input type="hidden" name="pegawai_id" id="pegawai_id">
	                <div class="modal-header bg-primary text-white">
	                    <h5 class="modal-title" id="modalIndikatorIntervensi">Indikator</h5>
	                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
	                </div>
	                <div class="modal-body">
	                    <ul id="indikatorSetuju">
	                    	<li></li>
           				</ul>
	                </div>
	                <div class="modal-footer">
	                    <button type="submit" class="btn btn-danger" name="status" value="tolak">Tolak</button>
	                    <button type="submit" class="btn btn-primary" name="status" value="setuju">Setuju</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
	{{-- Modal Hapus Intervensi SKP --}}
	<div class="modal fade" id="modalHapusIntervensi" tabindex="-1" aria-labelledby="modalHapusIntervensi" aria-hidden="true">
	    <div class="modal-dialog modal-custom-width">
	        <div class="modal-content">
	            <form id="formHapusPoin" action="{{ route('intervensiDelete') }}" method="POST">
	                @csrf
	                <input type="hidden" name="skp_id" id="hapusSkpId">
	                <input type="hidden" name="intervensi_id" id="hapusIntervensiId">
	                <div class="modal-header bg-danger text-white">
	                    <h5 class="modal-title" id="modalHapusIntervensi">Hapus Intervensi</h5>
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
        const periodeSelect = document.getElementById('periode_id');
        const hiddenPeriodeInput = document.getElementById('periode_id_hidden');
        if (periodeSelect && hiddenPeriodeInput) {
            periodeSelect.addEventListener('change', function () {
                hiddenPeriodeInput.value = this.value;
            });
            hiddenPeriodeInput.value = periodeSelect.value;
        }

        const modalHapus = document.getElementById('modalHapusIntervensi');
        if (modalHapus) {
            modalHapus.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (!button) return;

                const skpId = button.getAttribute('data-skp-id');
                const intervensiId = button.getAttribute('data-intervensi-id');
                const nama = button.getAttribute('data-nama');
                const intervensi = button.getAttribute('data-intervensi');

                modalHapus.querySelector('#hapusSkpId').value = skpId;
                modalHapus.querySelector('#hapusIntervensiId').value = intervensiId;

                const pesan = `Hapus intervensi <strong>${nama}</strong> (SKP: <em>${intervensi}</em>)?`;
                modalHapus.querySelector('#pesanKonfirmasi').innerHTML = pesan;
            });
        }

        const indikatorButtons = document.querySelectorAll('.btn-indikator');
        const skpIdIndikator = document.getElementById('skpIdIndikator');
        const intervensiIdIndikator = document.getElementById('intervensiIdIndikator');
        const pegawaiIdIndikator = document.getElementById('pegawai_id')
        const indikatorSetuju = document.getElementById('indikatorSetuju');
        const formIndikator = document.getElementById('formIndikatorPoin');
        const modalIndikatorEl = document.getElementById('modalIndikatorIntervensi');

        if (indikatorButtons.length && skpIdIndikator && intervensiIdIndikator && indikatorSetuju && formIndikator && modalIndikatorEl) {
            indikatorButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const skpId = this.getAttribute('data-skp-id');
                    skpIdIndikator.value = skpId;
                    const intervensiId = this.getAttribute('data-intervensi-id');
                    intervensiIdIndikator.value = intervensiId;
                    const pegawaiId = this.getAttribute('data-pegawai-id');
                    pegawaiIdIndikator.value = pegawaiId;
                    formIndikator.setAttribute('action', `/intervensi/intervensiSetuju`);
                    indikatorSetuju.innerHTML = '';

                    fetch(`/intervensi/indikatorGet/${pegawaiId}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal mengambil data indikator.');
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(indikator => {
                                const li = document.createElement('li');
                                li.textContent = indikator.indikator;
                                indikatorSetuju.appendChild(li);
                            });

                            const modal = new bootstrap.Modal(modalIndikatorEl);
                            modal.show();
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });
                });
            });
        }
    });
</script>
@endsection