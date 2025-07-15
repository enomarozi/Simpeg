@extends('index')
@section('content')
<div class="container-fluid mt-3">
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
                                    <a href="{{ route('set_active_periode', $periode->status) }}"
                                       class="btn btn-sm px-3 {{ $periode->status ? 'btn-success' : 'btn-secondary' }}"
                                       title="Klik untuk {{ $periode->status ? 'nonaktifkan' : 'aktifkan' }}">
                                        <i class="bi {{ $periode->status ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('skp_periode_del', $periode->id) }}" method="POST" onchange="this.form.submit()" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Periode">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
                            <label for="mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="mulai" id="mulai" required>
                        </div>
                        <div class="mb-3">
                            <label for="selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="selesai" id="selesai" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
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
</div>
@endsection
