@extends('index')
@section('content')
<div class="container-fluid">
	<div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>{{ $title }}</h4>
        </div>
    </div>
    <div class="card mb-4 bg-opacity-10 border">
        <div class="card-body">
            <form action="{{ route('periodeTriwulan') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <label for="periode_id" class="form-label fw-semibold">Triwulan</label>
                        <select name="triwulan" id="triwulan" class="form-select" onchange="this.form.submit()" required>
                            <option value="" disabled {{ empty($triwulan ?? null) ? 'selected' : '' }}>-- Pilih Triwulan --</option>
                            <option value="1" {{ $triwulan == 1 ? 'selected' : '' }}>Triwulan 1</option>
                            <option value="2" {{ $triwulan == 2 ? 'selected' : '' }}>Triwulan 2</option>
                            <option value="3" {{ $triwulan == 3 ? 'selected' : '' }}>Triwulan 3</option>
                            <option value="4" {{ $triwulan == 4 ? 'selected' : '' }}>Triwulan 4</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="unit_kerja" class="form-label fw-semibold">Unit Kerja</label>
                        <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" value="Universitas Andalas" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(empty($periode))
    <div class="alert alert-light text-center fw-semibold border rounded shadow-sm py-3">
        <i class="bi bi-exclamation-circle me-2 text-secondary"></i>
        Silakan pilih periode terlebih dahulu.
    </div>
    @else
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
            <table id="menus-table" class="table table-hover align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama Staff</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($staffs) && $staffs->count())
                    @foreach($staffs as $index => $staff)
                        <tr>
                            <td class="text-center align-top">{{ $index + 1 }}</td>
                            <td class="text-center align-top">{{ $staff->pegawai->nama }}</td>
                            <td class="text-center align-top">
                                <div>
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-outline-success btn-detail-log" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modelDetailLog" 
                                        data-id="{{ $staff->pegawai->id }}"
                                        data-periode="{{ $staff->periode_id }}"
                                        data-triwulan="{{ $staff->triwulan}}"> 
                                        <i class="bi bi-pencil-square me-1"></i> Detail 
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>
    @endif
</div>
@if(!empty($periode))
{{-- Modal Detail --}}
<div class="modal fade" id="modelDetailLog" tabindex="-1" aria-labelledby="modalDetailLogLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-80">
        <div class="modal-content modal-content-rekap border border-success rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLogLabel">Detail Log Triwulan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="log-detail-table" class="table table-hover align-middle mb-0">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                                <th>Deskripsi</th>
                                <th>SKP</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody id="log-detail-tbody">
                            <tr><td colspan="6" class="text-center">Pilih bulan untuk melihat data...</td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-detail-log').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const periode = this.getAttribute('data-periode');
            const triwulan = this.getAttribute('data-triwulan');
            const tbody = document.getElementById('log-detail-tbody');
            tbody.innerHTML = '<tr><td colspan="7" class="text-center">Loading...</td></tr>';
            fetch(`getTriwulan/${id}/${periode}/${triwulan}`)
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Terjadi kesalahan saat mengambil data.');
                    }
                    return data;
                })
                .then(data => {
                    const logs = Array.isArray(data) ? data : Object.values(data);
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="7" class="text-center">Tidak ada data log untuk triwulan ini.</td></tr>';
                        return;
                    }
                    logs.forEach((log, index) => {
                        const row = `
                            <tr>
                                <td class="text-center align-top">${index + 1}</td>
                                <td class="text-center align-top">${log.tanggal}</td>
                                <td class="text-center align-top">${log.nama_aktivitas}</td>
                                <td class="text-center align-top">${log.deskripsi}</td>
                                <td class="text-center align-top">${log.skp ?? '-'}</td>
                                <td class="text-center align-top">${log.link ? `<a href="${log.link}" target="_blank">Lihat</a>` : '-'}</td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Gagal memuat data: ${error.message}</td></tr>`;
                });
        });
    });
});
</script>
@endif
@endsection