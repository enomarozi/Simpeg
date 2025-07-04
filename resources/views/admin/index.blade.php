@extends('index')
@section('content')
<h4>{{ $title }}</h4>
<table id="menus-table" class="table table-hover align-middle mb-0">
    <thead class="table-secondary text-center">
        <tr>
            <th>#</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Fakultas</th>
            <th>Departemen</th>
            <th>Status Kepegawaian</th>
            <th>Golongan</th>
            <!-- <th>Pangkat</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="menus-tbody">
    </tbody>
</table>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    fetch('json_pegawai')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('menus-tbody');
        tbody.innerHTML = '';
        let autoIncrementId = 1;
        data.forEach(menu => {
            const row = document.createElement('tr');
            const noCell = document.createElement('td');
            noCell.textContent += autoIncrementId;
            row.appendChild(noCell);
            autoIncrementId++;

            const nipCell = document.createElement('td');
            nipCell.textContent = menu.nip;
            row.appendChild(nipCell);

            const namaCell = document.createElement('td');
            namaCell.textContent = menu.nama;
            row.appendChild(namaCell);

            const fakultasCell = document.createElement('td');
            fakultasCell.textContent = menu.nama_fakultas;
            row.appendChild(fakultasCell);

            const departemenCell = document.createElement('td');
            departemenCell.textContent = menu.nama_departemen;
            row.appendChild(departemenCell);

            const kategoriKepegawaianCell = document.createElement('td');
            kategoriKepegawaianCell.textContent = menu.nama_kategori_kepegawaian;
            row.appendChild(kategoriKepegawaianCell);

            const golonganCell = document.createElement('td');
            golonganCell.textContent = menu.golongan;
            row.appendChild(golonganCell);

            // const pangkatCell = document.createElement('td');
            // pangkatCell.textContent = menu.pangkat;
            // row.appendChild(pangkatCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `
                <a href="detail/${menu.id}" class="btn btn-xs btn-info" data-toggle="tooltip" title="Detail">
                    <i class="fas fa-info-circle"></i> <!-- Ikon Detail -->
                </a>
                <a href="delete/${menu.id}" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete">
                    <i class="fas fa-trash-alt"></i> <!-- Ikon Delete -->
                </a>
            `;
            
            row.appendChild(actionCell);
            tbody.appendChild(row);
        });
        $('#menus-table').DataTable();
    });
});
</script>
@endsection