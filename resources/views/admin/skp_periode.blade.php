@extends('index')
@section('content')
<div class="container-fluid mt-3">
    {{-- Tombol untuk buka modal --}}
    <div class="mb-3 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPeriode">
            <i class="bi bi-plus-circle"></i> Tambah Periode
        </button>
    </div>

    {{-- Tabel Periode --}}
    <div class="card border">
        <div class="card-header">
            <h5 class="mb-0">Daftar Periode SKP</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                                    <span class="badge {{ $periode->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($periode->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{-- Aksi Edit & Delete bisa ditambahkan di sini --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data periode SKP.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahPeriode" tabindex="-1" aria-labelledby="modalTambahPeriodeLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="{{ route('skp.periodeAction') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-light text-dark">
                        <h5 class="modal-title" id="modalTambahPeriodeLabel">Tambah Periode SKP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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
