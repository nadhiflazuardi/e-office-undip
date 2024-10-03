@extends('layouts.main')

@section('container')
    <style>
        .color-sample {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
            vertical-align: middle;
            border: 1px solid #ccc;
            border-radius: 50%;
        }
    </style>
    <div class="">
        {{ Breadcrumbs::render() }}
    </div>
    <h1>Unggah Bukti Tugas</h1>
    <hr>
    <form action="{{ route('tugas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judulInput" class="form-label">Judul tugas</label>
            <input class="form-control @error('judul') is-invalid @enderror" type="text" name="judul" id="judulInput"
                value="{{ old('judul') }}">
            @error('judul')
                <label for="judulInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <label for="perihalInput" class="form-label" value="{{ old('perihal') }}">Uraian Tugas</label>
            <select class="form-select @error('uraian') is-invalid @enderror" name="uraian" id="uraianInput">
                <option value="">Pilih uraian</option>
                @foreach ($uraianTugas as $uraian)
                    <option value={{ $uraian['id'] }} @selected(old('uraian') == $uraian['id'])>{{ $uraian['nama_tugas'] }}</option>
                @endforeach
            </select>
            @error('uraian')
                <label for="uraianInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="tanggalInput" class="form-label ">Tanggal</label>
                <input class="form-control  @error('tanggal') is-invalid @enderror" type="date" name="tanggal"
                    id="tanggalInput" value="{{ old('tanggal') }}">
                @error('tanggal')
                    <label for="tanggalInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col">
                <label for="tempatInput" class="form-label">Tempat</label>
                <select class="form-select @error('tempat') is-invalid @enderror" name="tempat" id="tempatInput">
                    <option value="">Pilih Tempat</option>
                    <option value="Tempat 1" @selected(old('tempat') == 'Tempat 1')>Tempat 1</option>
                    <option value="Tempat 2" @selected(old('tempat') == 'Tempat 2')>Tempat 2</option>
                    <option value="Tempat 3" @selected(old('tempat') == 'Tempat 3')>Tempat 3</option>
                    <option value="Tempat 4" @selected(old('tempat') == 'Tempat 4')>Tempat 4</option>
                    <option value="Tempat 5" @selected(old('tempat') == 'Tempat 5')>Tempat 5</option>
                </select>
                @error('tempat')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="waktuMulaiInput" class="form-label ">Waktu Mulai</label>
                <input class="form-control @error('waktuMulai') is-invalid @enderror" type="time" name="waktuMulai"
                    id="waktuMulaiInput" value="{{ old('waktuMulai') }}">
                @error('waktuMulai')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col">
                <label for="pimpinanInput" class="form-label">Pimpinan tugas</label>
                <select class="form-select @error('pemimpintugas') is-invalid @enderror" name="pemimpintugas"
                    id="pimpinanInput">
                    <option value="">Pilih Pimpinan</option>
                </select>
                @error('pemimpintugas')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="waktuSelesaiInput" class="form-label ">Waktu Selesai</label>
                <input class="form-control @error('waktuSelesai') is-invalid @enderror" type="time" name="waktuSelesai"
                    id="waktuSelesaiInput" value="{{ old('waktuSelesai') }}">
                @error('waktuSelesai')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-end gap-1">
            <button class="btn btn-primary header1" style="width: 100px" type="submit">Simpan</button>
            <button class="btn btn-outline-primary" style="width: 100px">Batal</button>
        </div>
    </form>
@endsection

@section('scripts')
@endsection
