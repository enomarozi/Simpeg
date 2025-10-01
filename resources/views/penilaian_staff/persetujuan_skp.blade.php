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
            <form action="{{ route('periodePersetujuan_skp') }}" method="GET">
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
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($staffs) && $staffs->count())
                    @foreach($staffs as $index => $staff)
                        <tr>
                            <td class="text-center align-top">{{ $index + 1 }}</td>
                            <td class="text-center align-top">{{ $staff->pegawai->nama }}</td>
                            <td class="text-center align-top">Pelaksana</td>
                            <td class="text-center align-top">-</td>
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
@endsection