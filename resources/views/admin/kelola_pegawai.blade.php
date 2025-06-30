@extends('index')
@section('content')
<div class="container-fluid mt-3">
    <div class="mb-3">
        <label for="atasan_id" class="form-label">Atasan</label>
        <select id="atasan_id" name="atasan_id" class="form-select">
            <option value="">-- Pilih Atasan --</option>
            @foreach ($pegawaiList as $atasan)
                <option value="{{ $atasan->id }}">{{ $atasan->nama }} ({{ $atasan->nip }})</option>
            @endforeach
        </select>
    </div>
</div>
@endsection