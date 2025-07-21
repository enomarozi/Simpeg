@extends('index')
@section('content')
<div class="container-fluid">
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>SKP Periode</h4>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPeriode">
            <i class="bi bi-plus-circle me-1"></i> Tambah Periode
        </button>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">{{ $title }}</h5>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($periodeList as $index => $periode)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $periode->tahun }}</td>
                                <td>{{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('set_active_periode', $periode->id) }}"
                                       class="btn btn-sm px-3 {{ $periode->is_active ? 'btn-success' : 'btn-secondary' }}"
                                       title="Klik untuk {{ $periode->is_active ? 'nonaktifkan' : 'aktifkan' }}">
                                        <i class="bi {{ $periode->is_active ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                                    </a>
                                </td>
                                <td>
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalHapusPeriode" 
                                        data-periode-id="{{ $periode->id }}"
                                        data-periode-tahun="{{ $periode->tahun }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data periode SKP.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Periode SKP --}}
<div class="modal fade" id="modalTambahPeriode" tabindex="-1" aria-labelledby="modalTambahPeriodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <form method="POST" action="{{ route('skp_periodeAction') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalTambahPeriodeLabel"><i class="bi bi-calendar-plus me-2"></i> Tambah Periode SKP</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="tahun" required placeholder="2025" min="2020" max="2100">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Hapus Periode SKP --}}
<div class="modal fade" id="modalHapusPeriode" tabindex="-1" aria-labelledby="modalHapusPeriode" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <div class="modal-content">
            <form id="formHapusPoin" action="{{ route('skp_periode_del') }}" method="POST">
                @csrf
                <input type="hidden" name="periode_id" id="hapusPeriodeId">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusPeriode">Hapus Periode</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p id="pesanKonfirmasi" class="text-center fw-semibold"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modalHapusPeriode');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const periodeId = button.getAttribute('data-periode-id');
            const periodeTahun = button.getAttribute('data-periode-tahun');

            modal.querySelector('#hapusPeriodeId').value = periodeId;
            const pesan = `Anda yakin ingin menghapus periode Tahun <strong>${periodeTahun}</strong>?<p class="text-danger"><i>( Akan menghapus seluruh SKP Pegawai 2026 )</i></p>`
            modal.querySelector('#pesanKonfirmasi').innerHTML = pesan;
        });
    });
</script>
@endsection
