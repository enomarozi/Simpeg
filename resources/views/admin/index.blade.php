@extends('index')
@section('content')
<table id="menus-table" class="display table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Fakultas</th>
            <th>Departemen</th>
            <th>Status Kepegawaian</th>
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
            console.log(menu)
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

            const permissionsCell = document.createElement('td');
            permissionsCell.textContent = menu.permissions;
            row.appendChild(permissionsCell);

            const descriptionCell = document.createElement('td');
            descriptionCell.textContent = menu.description;
            row.appendChild(descriptionCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `
                <button onClick='modalEdit(${menu.id},"${menu.name}","${menu.description}")' class="btn btn-xs btn-success">Edit</button>
                <button onClick='modalEdit(${menu.id},"${menu.name}","${menu.description}")' class="btn btn-xs btn-success">Edit</button>
                <button onClick='modalDelete(${menu.id})' class="btn btn-xs btn-danger">Delete</button>
            `;
            
            row.appendChild(actionCell);
            tbody.appendChild(row);
        });
        $('#menus-table').DataTable();
    });
});
</script>
@endsection