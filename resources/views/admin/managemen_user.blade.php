@extends('index')

@section('content')
<h4>{{ $title }}</h4>
    <table id="menus-table" class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Pegawai_ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $u)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td style="min-width: 220px;">
                        <form action="{{ route('set_id_pegawai') }}" method="POST" class="mb-0">
                            @csrf
                            <input type="hidden" name="username" value="{{ $u->username }}">
                            <select name="pegawai_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">-- Pilih Pegawai --</option>
                                @foreach($pegawai as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $u->pegawai_id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('set_active_pegawai', $u->id) }}"
                           class="btn btn-sm px-3 {{ $u->is_active ? 'btn-success' : 'btn-secondary' }}"
                           title="Klik untuk {{ $u->is_active ? 'nonaktifkan' : 'aktifkan' }}">
                            <i class="bi {{ $u->is_active ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    $(document).ready(function () {
        $('#menus-table').DataTable();
    });
</script>
@endsection
