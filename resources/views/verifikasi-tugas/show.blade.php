@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render() }}
    </div>
    <h1>{{ $tugas->judul }}</h1>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="">
        <h6>Pegawai</h6>
        <p>{{ $tugas->pegawai->nama }}</p>
        <h6>Uraian Tugas</h6>
        <p>{{ $tugas->uraian_tugas }}</p>
        <h6>Keterangan</h6>
        <p>{{ $tugas->keterangan }}</p>
        <h6>Waktu Pengumpulan</h6>
        <p>{{ $tugas->waktu_pengumpulan }}</p>
        <hr>
        <h5>Status Verifikasi Tugas</h5>
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
        <hr>
        <a href="{{ asset('storage/luaran_tugas/' . $tugas->file_luaran) }}" target="blank"
            class="d-inline-block btn btn-primary">Lihat Bukti Penyelesaian Tugas</a>
        @if ($tugas->status == 'sedang diperiksa')
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTerima">
                Terima tugas
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak">
                Revisi tugas
            </button>

            {{-- Modal Terima --}}
            <div class="modal fade" id="modalTerima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Terima tugas?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menerima tugas ini? Status tugas yang sudah diterima tidak dapat diubah
                            lagi.
                        </div>
                        <div class="modal-footer">
                            <form
                                action="{{ route('tugas.verifikasi.terima', ['tugas' => $tugas->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Ya</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Tolak --}}
            <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Revisi Tugas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form
                            action="{{ route('tugas.verifikasi.tolak', ['tugas' => $tugas->id]) }}"
                            method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan Perbaikan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan" rows="3"
                                        placeholder="Mohon berikan catatan perbaikan" required></textarea>
                                    @error('catatan')
                                        <label for="catatan" class="invalid-feedback">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Revisi Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        @endif
        @if ($tugas->riwayatVerifikasi->count())
            <h6 class="mt-3">Riwayat Verifikasi</h6>
            <ol class="list-group list-group-numbered w-50">
                @foreach ($tugas->riwayatVerifikasi as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-semibold">{{ $item->verifikator->nama }}</div>
                            <p class="fw-semibold">{{ $item->verifikator->jabatan->nama }}</p>
                            <p class="fs-6 text-muted">{{ $item->created_at->diffForHumans() }}</p>
    
                            @if ($item->status == 'ditolak')
                                <p class="text-capitalize">Alasan : {{ $item->catatan }}</p>
                            @endif
                        </div>
                        <span
                            class="text-capitalize badge {{ $item->status == 'disetujui' ? 'text-bg-success' : 'text-bg-danger' }} rounded-pill">{{ $item->status }}</span>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>
@endsection
