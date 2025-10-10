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
                        <th>Status SKP</th>
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
                            <td class="text-center align-top">{{ $countDiajukan[$staff->pegawai_id] ?? 0 }} diajukan</td>
                            <td class="text-center align-top">
                                <div>
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-outline-success btn-detail-log" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modelDetailLog" 
                                        data-id="{{ $staff->pegawai->id }}"
                                        data-periode="{{ $staff->periode_id }}">
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
    <div class="modal-dialog modal-custom-95">
        <div class="modal-content modal-content-persetujuan border border-success rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLogLabel">Detail SKP Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <p>Loading...</p>
            </div>
            <form action="{{ route('actionDiajukan') }}" method="POST">
                @csrf
                <input type="hidden" id='pegawai_id' name='pegawai_id'>
                <input type="hidden" id='periode_id_ajukan' name='periode_id'>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger" name="action" value="ditolak">Ditolak</button>
                    <button type="submit" class="btn btn-success" name="action" value="disetujui">Diterima</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        var modelDetailLog = document.getElementById('modelDetailLog');
        var modalContent = modelDetailLog.querySelector('#modalContent');
        modelDetailLog.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            var pegawaiId = button.getAttribute('data-id');
            var periodeId = button.getAttribute('data-periode');
            document.getElementById('pegawai_id').value = pegawaiId;
            document.getElementById('periode_id_ajukan').value = periodeId;
            modalContent.innerHTML = "<p>Loading..</p>";
            fetch(`/staff/diajukan/${pegawaiId}/${periodeId}`)
                .then(response=>response.json())
                .then(data=>{
                    const oldTextarea = modelDetailLog.querySelector('#indikator');
                    if (oldTextarea) {
                      oldTextarea.parentNode.remove();
                    }
                    if(!data.length){
                        modalContent.innerHTML = "<p>Tidak ada SKP yg diajukan.</p>";
                        return;
                    }
                    let html = `
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Judul / Nama SKP</th>
                                    <th>Status</th>
                                    <th>Indikator</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    data.forEach((skp, index) => {
                        let indikatorHTML = '<ul class="mb-0">';
                        if (skp.indikator_list && skp.indikator_list.length > 0) {
                            skp.indikator_list.forEach(indikator => {
                                indikatorHTML += `<li>${indikator.indikator ?? '-'}</li>`;
                            });
                        } else {
                            indikatorHTML += '<li><em class="text-muted">Belum ada indikator</em></li>';
                        }
                        indikatorHTML += '</ul>';
                        html += `
                          <tr>
                            <td class="text-center">${index + 1}</td>
                            <td>${skp.skp ?? '-'}</td>
                            <td class="text-center">
                              <span class="badge bg-primary">${skp.status}</span>
                            </td>
                            <td>${indikatorHTML}</td>
                          </tr>
                        `;
                    });
                    html += `
                            </tbody>
                        </table>
                    </div>
                    `;
                    modalContent.innerHTML = html;
                    const textareaDiv = document.createElement('div');
                    textareaDiv.classList.add('mb-3');
                    textareaDiv.innerHTML = `
                        <label for="indikator" class="form-label">Pesan ke Staff</label>
                        <textarea name="pesan" id="pesan" class="form-control" rows="3"></textarea>
                    `;
                    const modalFooter = modelDetailLog.querySelector('.modal-footer');
                    modalFooter.parentNode.insertBefore(textareaDiv, modalFooter);
                })
                .catch(()=>{
                    modalContent.innerHTML = '<p>Gagal mengambil data SKP.</p>';
                });
        });
    });
</script>
@endif
@endsection