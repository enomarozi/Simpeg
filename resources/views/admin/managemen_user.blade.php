@extends('index')

@section('content')
<h4>{{ $title }}</h4>
    <table id="menus-table" class="display table table-striped table-bordered">
        <thead>
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
                    <td>
                        <form action="{{ route('set_id_pegawai') }}" method="POST">
                            @csrf
                            <input type="hidden" name="username" value="{{ $u->username }}">
                            <select class="form-select" name="pegawai_id" onchange="this.form.submit()">
                                <option value="">-- Pilih Pegawai ID --</option>
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
                           class="btn btn-sm {{ $u->is_active ? 'btn-success' : 'btn-secondary' }}"
                           title="Klik untuk {{ $u->is_active ? 'nonaktifkan' : 'aktifkan' }} user">
                            <i class="fas {{ $u->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '{{ session('success') }}',
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
        });
    @endif
</script>

<script>
    $(document).ready(function () {
        $('#menus-table').DataTable();
    });
</script>
@endsection
