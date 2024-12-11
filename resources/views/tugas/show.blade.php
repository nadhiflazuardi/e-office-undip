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
    <div class="">
        <h6>Pegawai</h6>
        <p>{{ $tugas->pegawai->nama }}</p>
        <h6>Uraian Tugas</h6>
        <p>{{ $tugas->uraian_tugas }}</p>
        <h6>Keterangan</h6>
        <p>{{ $tugas->keterangan }}</p>
        <h6>Waktu Pengumpulan</h6>
        <p>{{ $tugas->waktu_pengumpulan }}</p>
        <a href="{{ asset('storage/luaran_tugas/' . $tugas->file_luaran) }}" target="blank"
            class="d-inline-block btn btn-primary">Lihat Bukti Tugas</a>
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
            <a class="btn btn-primary" href="{{ route('tugas.edit', ['tugas' => $tugas]) }}">Perbaiki</a>
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
        <hr>
    </div>
@endsection
