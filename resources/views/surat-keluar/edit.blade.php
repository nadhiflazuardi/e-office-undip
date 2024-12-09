@extends('layouts.main')

@section('container')
    <div class="ms-3">
        {{ Breadcrumbs::render() }}
    </div>
    <div class="border-bottom border-black">
        <h1 class="ms-3">Edit Surat Keluar</h1>
    </div>
    <br>
    <div class="mb-3">
            <a href="{{ asset('storage/surat_keluar/' . $surat->file_surat) }}" target="blank" class="d-inline-block btn btn-primary">Lihat
                File Surat</a>

            <h6 class="mt-3">Status Verifikasi Surat Keluar</h6>
            <p
                class="badge rounded-pill 
    {{ str_contains($surat->status, 'Menunggu') ? 'text-bg-primary' : '' }}
    {{ $surat->status == 'Disetujui' ? 'text-bg-success' : '' }}
    {{ str_contains($surat->status, 'Revisi') ? 'text-bg-danger' : '' }} fs-6">
                {{ $surat->status }}</p>
            @if (str_contains($surat->status, 'Revisi'))
                <h6 class="m-0 p-0">Alasan penolakan : </h6>
                <p>{{ $surat->alasanPenolakan() }}</p>
            @endif

        </div>
    <form action="{{ route('surat-keluar.update',['surat' => $surat]) }}" enctype="multipart/form-data" method="POST" class="input-container ">
        @csrf
        @method('PATCH')
        <div class="row gy-3 mb-3">
            <div class="col-6">
                <label for="tanggalSuratInput" class="form-label">Tanggal Surat</label>
                <input type="date" name="tanggal_surat" id="tanggalSuratInput"
                    class="form-control @error('tanggal_surat') is-invalid @enderror" value="{{ old('tanggal_surat') ?? $surat->tanggal_dikirim }}">
                @error('tanggal_surat')
                    <label for="tanggalSuratInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6">
                <label for="perihalSuratInput" class="form-label">Perihal Surat</label>
                <input type="text" name="perihal" id="perihalSuratInput"
                    class="form-control @error('perihal') is-invalid @enderror" placeholder="Masukkan perihal/tajuk surat"
                    value="{{ old('perihal') ?? $surat->perihal }}">
                @error('perihal')
                    <label for="perihalSuratInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row gy-3 mb-3">
            <div class="col-6">
                <label for="asalSuratInput" class="form-label ">Asal Surat</label>
                <input type="text" name="asal" id="asalSuratInput"
                    class="form-control @error('asal') is-invalid @enderror"
                    placeholder="Masukkan nama instansi/orang pengirim surat" value="{{ old('asal') ?? $surat->asal }}">
                @error('asal')
                    <label for="asalSuratInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6">
                <label for="tujuanSuratInput" class="form-label ">Tujuan Surat</label>
                <input type="text" name="tujuan" id="tujuanSuratInput"
                    class="form-control @error('tujuan') is-invalid @enderror"
                    placeholder="Masukkan pejabat/bagian penerima surat" value="{{ old('tujuan') ?? $surat->tujuan }}">
                @error('tujuan')
                    <label for="tujuanSuratInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row gy-3 mb-3">
            <div class="col-6">
                <label for="alamatSuratInput" class="form-label ">Alamat Surat</label>
                <input type="text" name="alamat" id="alamatSuratInput"
                    class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat tujuan surat "
                    value="{{ old('alamat') ?? $surat->alamat_surat }}">
                @error('alamat')
                    <label for="alamatSuratInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-6">
                <label for="penandatanganInput" class="form-label d-block">Penandatangan Surat</label>
                <select name="penandatangan_id" id="penandatanganInput" class="select2 w-100 m-0 p-0 @error('penandatangan_id') is-invalid @enderror" style="width: 100%; height: 100%;">
                    <option value="">Pilih Penandatangan Surat</option>
                    @foreach ($penandatangan as $penandatangan)
                        @if ($penandatangan->id == auth()->id())
                            @continue
                        @endif
                        <option value="{{ $penandatangan->id }}" @selected(old('penandatangan_id') == $penandatangan->id || $surat->penandatangan_id == $penandatangan->id)>{{ $penandatangan->nama }}</option>
                    @endforeach
                </select>
                @error('penandatangan_id')
                    <label for="penandatanganInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="my-3">
            <label for="formFile" class="form-label">Unggah file surat yang sudah diperbaiki dalam format .pdf dengan
                ukuran maksimal 5MB</label>
            <input
                class="form-control @error('file_surat')
                            is-invalid
                        @enderror"
                name="file_surat" type="file" id="formFile" value="{{ old('file_surat') }}">
            @error('file_surat')
                <label for="formFile" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="d-flex justify-content-end gap-1">
            <button class="btn btn-primary header1" style="width: 100px" type="submit">Simpan</button>
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-outline-primary" style="width: 100px">Batal</a>
        </div>
    </form>
@endsection

@section('scripts')
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        $('#document').ready(function() {
            $('#penandatanganInput').select2({
                placeholder: "Pilih Penandatangan Surat",
            });
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#isiSurat'), {
                    placeholder: 'Silahkan Ketik isi surat di sini'
                })
                .catch(error => {
                    console.error(error);
                });
        })
    </script>
@endsection
