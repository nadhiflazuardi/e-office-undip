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
    <h1>Edit Unggahan Bukti Tugas</h1>
    <hr>
    <a href="{{ asset('storage/luaran_tugas/' . $tugas->file_luaran) }}" target="blank"
            class="d-inline-block btn btn-primary">Lihat Bukti Tugas</a>
    <h5 class="mt-3">Status Verifikasi Tugas</h5>
    <p
        class="badge rounded-pill text-capitalize
    {{ $tugas->status == 'sedang diperiksa' ? 'text-bg-primary' : '' }}
    {{ $tugas->status == 'disetujui' ? 'text-bg-success' : '' }}
    {{ $tugas->status == 'ditolak' ? 'text-bg-danger' : '' }} fs-6">
        {{ $tugas->status }}</p>
    @if ($tugas->status == 'ditolak')
        <h6 class="m-0 p-0">Alasan penolakan : </h6>
        <p>{{ $tugas->alasanPenolakan()[0] }}</p>
    @endif
    <form method="POST" action="{{ route('tugas.update', ['tugas' => $tugas]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="judulInput" class="form-label">Judul tugas</label>
            <input class="form-control @error('judul') is-invalid @enderror" type="text" name="judul" id="judulInput"
                value="{{ old('judul') ?? $tugas->judul }}">
            @error('judul')
                <label for="judulInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            {{-- uraian is actually detailAbk --}}
            <label for="perihalInput" class="form-label" value="{{ old('perihal') }}">Uraian Tugas</label>
            <select class="form-select @error('uraian') is-invalid @enderror" name="uraian" id="uraianInput">
                <option value="">Pilih uraian</option>
                @foreach ($detailAbk as $uraian)
                    <option value="{{ $uraian['nama_tugas'] }}" data-bobot="{{ $uraian['bobot'] }}"
                        data-target="{{ $uraian['target'] }}" @selected($tugas->uraian_tugas == $uraian['nama_tugas'] || $uraian['nama_tugas'] == old('uraian'))>
                        {{ $uraian['nama_tugas'] }}</option>
                @endforeach
            </select>
            <input type="hidden" name="bobot" id="bobotInput" value="{{ $tugas->bobot }}">
            <input type="hidden" name="target" id="targetInput" value="{{ $tugas->target }}">
            @error('uraian')
                <label for="uraianInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keteranganInput" class="form-label">Keterangan</label>
            <input class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan"
                id="keteranganInput" value="{{ old('keterangan') ?? $tugas->keterangan }}">
            @error('keterangan')
                <label for="keteranganInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fileInput" class="form-label">Upload File</label>
            <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="fileInput"
                aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
                Silakan unggah file baru jika ingin mengganti file yang sudah ada.
            </div>
            @error('file')
                <label for="fileInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="d-flex justify-content-end gap-1">
            <button class="btn btn-primary header1" style="width: 100px" type="submit">Simpan</button>
            <a href="{{ route('tugas.show', ['tugas' => $tugas]) }}" class="btn btn-outline-primary"
                style="width: 100px">Batal</a>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#uraianInput').on('change', function() {
                // Ambil option yang dipilih
                var selectedOption = $(this).find('option:selected');
                console.log(selectedOption);

                // Ambil value dari data-bobot
                var bobot = selectedOption.data('bobot');
                console.log(bobot);

                // Update hidden input
                $('#bobotInput').val(bobot);

                // Ambil value dari data-target
                var target = selectedOption.data('target');
                console.log(target);

                // Update hidden input
                $('#targetInput').val(target);
            });
        });
    </script>
@endsection
