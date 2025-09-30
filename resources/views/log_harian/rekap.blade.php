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
            <form action="{{ route('periodeRekap') }}" method="GET">
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
            <table id="menus-table" class="table table-hover align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Bulan</th>
                        <th>Jumlah Hari Kerja</th>
                        <th>Jumlah Log</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                @if(!empty($perBulan))
                @foreach ($perBulan as $bulanNama => $logList)
                <tr>
                    <td class="text-center align-top">{{ $loop->iteration }}</td>
                    <td class="text-center align-top">{{ $bulanNama }}</td>
                    <td class="text-center align-top">{{ $logList->count() }}</td>
                    <td class="text-center align-top">{{ $logList->count() }}</td>
                    <td class="text-center align-top">
                        <button
                            type="button" 
                            class="btn btn-sm btn-outline-success btn-detail-log" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modelDetailLog" 
                            data-bulan="{{ $bulanNama }}">
                            <i class="bi bi-pencil-square me-1"></i> Detail 
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@if(!empty($periode))
{{-- Modal Detail --}}
<style>
.modal-content {
    width: 80%;
    margin: 5% 10% 0% 10%;
}
.modal-custom-60 {
    max-width: 80vw !important;
    width: 80vw !important;
}
</style>

<div class="modal fade" id="modelDetailLog" tabindex="-1" aria-labelledby="modalDetailLogLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-60">
        <div class="modal-content border border-success rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLogLabel">Detail Log Aktivitas</h5>
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
            const bulan = this.getAttribute('data-bulan');
            const tbody = document.getElementById('log-detail-tbody');
            if (!tbody) {
                console.error('Tbody untuk detail log tidak ditemukan!');
                return;
            }
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">Loading...</td></tr>';

            fetch(`log-detail/${bulan}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center">Tidak ada data log untuk bulan ini.</td></tr>';
                        return;
                    }
                    data.forEach((log, index) => {
                        const row = `
                            <tr>
                                <td class="text-center align-top">${index + 1}</td>
                                <td class="text-center align-top">${log.tanggal}</td>
                                <td class="text-center align-top">${log.nama_aktivitas}</td>
                                <td class="text-center align-top">${log.deskripsi}</td>
                                <td class="text-center align-top">${log.skp}</td>
                                <td class="text-center align-top">${log.link}</td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    displayArea.textContent = 'Gagal memuat data: ' + error.message;
                });
        });
    });
});
</script>
@endif
@endsection