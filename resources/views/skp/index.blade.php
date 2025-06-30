@extends('index')
@section('content')
<div class="container-fluid mt-3">
<h1>Daftar SKP</h1>
<a href="{{ route('skp.create') }}" class="btn btn-primary mb-2">+ Tambah SKP</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Pegawai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($skps as $skp)
        <tr>
            <td>{{ $skp->judul }}</td>
            <td>{{ $skp->deskripsi }}</td>
            <td>{{ $skp->user->name ?? '-' }}</td>
            <td>
                <a href="{{ route('skp.show', $skp) }}" class="btn btn-sm btn-info">Lihat</a>
                @can('update', $skp)
                <a href="{{ route('skp.edit', $skp) }}" class="btn btn-sm btn-warning">Edit</a>
                @endcan
                @can('delete', $skp)
                <form action="{{ route('skp.destroy', $skp) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection