@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render() }}
    </div>
    <h1>{{ $sppd->keperluan_perjalanan }}</h1>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="">
        <h6>Nomor SPPD</h6>
        <p>{{ $sppd->nomor_surat }}</p>
        <h6>Pemberi Perintah</h6>
        <p>{{ $sppd->pemberiPerintah->nama }} | {{ $sppd->pemberiPerintah->jabatan->nama }}</p>
        <h6>Alamat Tujuan Perjalanan</h6>
        <p>{{ $sppd->alamat_perjalanan }}</p>
        <h6>Tanggal Mulai</h6>
        <p>{{ $sppd->tanggalMulai() }}</p>
        <h6>Tanggal Selesai</h6>
        <p>{{ $sppd->tanggalSelesai() }}</p>
        <h6>Anggaran</h6>
        <p>{{ $sppd->anggaran() }}</p>
        @if ($sppd->laporanPerjalananDinas)
            <a href="{{ Storage::url($sppd->laporanPerjalananDinas->file_laporan) }}" target="blank"
                class="d-inline-block btn btn-primary">Lihat Laporan Dinas</a>
        @endif
        <hr>

        @if (!$sppd->laporanPerjalananDinas)
            <h2>Unggah Laporan Perjalanan Dinas</h2>
            {{-- <p>{{ $sppd->laporanPerjalananDinas->status }}</p> --}}
            <form action="{{ route('laporan-dinas.store') }}" enctype="multipart/form-data" class="row gy-3"
                method="POST">
                @csrf
                <div class="">
                    <label for="formFile" class="form-label">Silahkan unggah file laporan dinas dalam format .pdf dengan
                        ukuran maksimal 5MB</label>
                    <input
                        class="form-control @error('file_laporan')
                        is-invalid
                    @enderror"
                        name="file_laporan" type="file" id="formFile">
                    @error('file_laporan')
                        <label for="formFile" class="invalid-feedback">{{ $message }}</label>
                    @enderror
                </div>
                <div class="">
                    <label for="keteranganInput" class="form-label">Keterangan</label>
                    <textarea type="text" name="keterangan" id="alamatPerjalananInput"
                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Silahkan isi keterangan bila perlu">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <label for="keteranganInput" class="invalid-feedback">{{ $message }}</label>
                    @enderror
                </div>
                <div class="">
                    <input type="hidden" name="perjalanan_dinas_id" value="{{ $sppd->id }}">
                    <input type="hidden" name="nomor_sppd" value="{{ $sppd->nomor_surat }}">
                    <button class="btn btn-primary header1" style="width: 100px" type="submit">Simpan</button>
                </div>
            </form>
        @else
            <h5>Status Verifikasi Laporan Dinas</h5>
            <p
                class="badge rounded-pill 
    {{ $sppd->laporanPerjalananDinas->status == 'Dalam Proses' ? 'text-bg-primary' : '' }}
    {{ $sppd->laporanPerjalananDinas->status == 'Disetujui' ? 'text-bg-success' : '' }}
    {{ $sppd->laporanPerjalananDinas->status == 'Ditolak' ? 'text-bg-danger' : '' }} fs-6">
                {{ $sppd->laporanPerjalananDinas->status }}</p>
            @if ($sppd->laporanPerjalananDinas->status == 'Ditolak')
                <h6 class="m-0 p-0">Alasan penolakan : </h6>
                <p>{{ $sppd->laporanPerjalananDinas->alasanPenolakan()[0] }}</p>
                <a class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Perbaiki</a>
            @endif
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Unggah Perbaikan Laporan Perjalanan Dinas
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('laporan-dinas.update', ['laporan' => $sppd->laporanPerjalananDinas]) }}"
                            enctype="multipart/form-data" class="" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                @csrf
                                <div class="">
                                    <label for="formFile" class="form-label">Silahkan unggah file laporan dinas dalam format
                                        .pdf dengan
                                        ukuran maksimal 5MB</label>
                                    <input class="form-control @error('file_laporan') is-invalid @enderror"
                                        name="file_laporan" type="file" id="formFile">
                                    @error('file_laporan')
                                        <label for="formFile" class="invalid-feedback">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="keteranganInput" class="form-label">Keterangan</label>
                                    <textarea type="text" name="keterangan" id="alamatPerjalananInput"
                                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Silahkan isi keterangan bila perlu">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <label for="keteranganInput" class="invalid-feedback">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="">
                                    <input type="hidden" name="perjalanan_dinas_id" value="{{ $sppd->id }}">
                                    <input type="hidden" name="nomor_sppd" value="{{ $sppd->nomor_surat }}">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary header1" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($sppd->laporanPerjalananDinas->riwayatVerifikasi->count())
                <h6 class="mt-3">Riwayat Verifikasi</h6>
                <ol class="list-group list-group-numbered w-50">
                    @foreach ($sppd->laporanPerjalananDinas->riwayatVerifikasi as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-semibold">{{ $item->verifikator->nama }}</div>
                                <p class="fw-semibold">{{ $item->verifikator->jabatan->nama }}</p>
                                <p class="fs-6 text-muted">{{ $item->created_at->diffForHumans() }}</p>

                                @if ($item->status == 'Ditolak')
                                    <p class="text-capitalize">Alasan : {{ $item->catatan }}</p>
                                @endif
                            </div>
                            <span
                                class="text-capitalize badge {{ $item->status == 'Disetujui' ? 'text-bg-success' : 'text-bg-danger' }} rounded-pill">{{ $item->status }}</span>
                        </li>
                    @endforeach
                </ol>
            @endif
        @endif
    </div>
@endsection
@section('scripts')
    @if ($errors->any())
        <script>
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            })
            modal.show()
        </script>
    @endif
@endsection
