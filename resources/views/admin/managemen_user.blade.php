@extends('index')

@section('content')
<h4>{{ $title }}</h4>
<div class="container-fluid mt-3">
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            <i class="bi bi-plus-circle me-1"></i> Tambah User
        </button>
    </div>
    <table id="menus-table" class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Pegawai_ID</th>
                <th>Role</th>
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
                        @if($u->roles->first()?->name !== 'admin')
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
                        @else
                            <span class="badge bg-secondary">999999</span>
                        @endif
                    </td>
                    <td style="min-width: 220px;">
                        @if($u->roles->first()?->name !== 'admin')
                            <form action="{{ route('set_role_pegawai') }}" method="POST" class="mb-0">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $u->id }}">
                                <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $u->roles->first()?->name == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <span class="badge bg-secondary">Admin</span>
                        @endif
                    </td>
                    <td>
                        @if($u->roles->first()?->name !== 'admin')
                            <a href="{{ route('set_active_pegawai', $u->id) }}"
                               class="btn btn-sm px-3 {{ $u->is_active ? 'btn-success' : 'btn-secondary' }}"
                               title="Klik untuk {{ $u->is_active ? 'nonaktifkan' : 'aktifkan' }}">
                                <i class="bi {{ $u->is_active ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-warning px-3" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $u->id }}">
                                <i class="bi bi-pencil-square fs-5" title="Edit User"></i>
                            </button>
                        @else
                            <span class="badge bg-secondary">Active</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

{{-- Tambah User --}}
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-width">
        <form action="{{ route('userAdd') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahUserLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                                <label for="nama">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="nip_niku" id="nip_niku" class="form-control" placeholder="NIP/NIKU">
                                <label for="nip_niku">NIP/NIKU</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="password" name="konfirmasi" id="konfirmasi" class="form-control" placeholder="Konfirmasi Password">
                                <label for="konfirmasi">Konfirmasi Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Update User --}}
@foreach($users as $u)
    <div class="modal fade" id="editUserModal{{ $u->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $u->id }}" aria-hidden="true">
        <div class="modal-dialog modal-custom-width">
            <form action="{{ route('userUpdate', $u->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="editUserModalLabel{{ $u->id }}">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $u->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username (NIP/NIKU)</label>
                            <input type="text" name="username" class="form-control" value="{{ $u->username }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $u->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach

<script>
    $(document).ready(function () {
        $('#menus-table').DataTable();
    });
</script>
@endsection
