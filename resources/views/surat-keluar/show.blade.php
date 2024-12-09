@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render() }}
    </div>
    <h1>{{ $surat->perihal }}</h1>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="">
        <h6>Nomor Surat</h6>
        <p>{{ $surat->nomor_surat }}</p>
        <h6>Penulis/Pengonsep</h6>
        <p>{{ $surat->penulis->nama }} | {{ $surat->penulis->jabatan->nama }}</p>
        <h6>Asal Surat</h6>
        <p>{{ $surat->asal }}</p>
        <h6>Tujuan Surat</h6>
        <p>{{ $surat->tujuan }}</p>
        <h6>Alamat Tujuan Surat</h6>
        <p>{{ $surat->alamat_surat }}</p>
        <h6>Tanggal Surat</h6>
        <p>{{ $surat->tanggalDibuat() }}</p>
        <h6>Penandatangan Surat</h6>
        <p>{{ $surat->penandatangan->nama }} | {{ $surat->penandatangan->jabatan->nama }}</p>
        <hr>

        <h5>Verifikasi Surat Keluar</h5>
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
                <a href="{{ route('surat-keluar.edit',['surat' => $surat]) }}" class="button btn btn-warning mb-3">Perbaiki</a>
            @endif
            @if ($surat->riwayatVerifikasi->count())
                <h6>Riwayat Verifikasi</h6>
                <ol class="list-group list-group-numbered w-50">
                    @foreach ($surat->riwayatVerifikasi as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-semibold">{{ $item->verifikator->nama }}</div>
                                <p class="fw-semibold">{{ $item->verifikator->jabatan->nama }}</p>
                                <p class="fs-6 text-muted">{{ $item->created_at->diffForHumans() }}</p>

                                @if ($item->status == 'Ditolak')
                                    <p>Alasan : {{ $item->catatan }}</p>
                                @endif
                            </div>
                            <span
                                class="badge {{ $item->status == 'Disetujui' ? 'text-bg-success' : 'text-bg-danger' }} rounded-pill">{{ $item->status }}</span>
                        </li>
                    @endforeach
                </ol>
            @endif
        </div>
    </div>
@endsection
