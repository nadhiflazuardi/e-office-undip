@extends('layouts.main')

@section('container')
    <div class="ms-3">
        {{ Breadcrumbs::render() }}
    </div>
    <div class="border-bottom border-black">
        <h1 class="ms-3">{{ $title }}</h1>
    </div>
    <br>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-menunggu-tab" data-bs-toggle="tab" data-bs-target="#nav-menunggu"
                type="button" role="tab" aria-controls="nav-menunggu" aria-selected="true">Menunggu
                Verifikasi Anda</button>
            <button class="nav-link " id="nav-perbaikan-tab" data-bs-toggle="tab" data-bs-target="#nav-perbaikan"
                type="button" role="tab" aria-controls="nav-perbaikan" aria-selected="true">Dalam Proses</button>
            <button class="nav-link " id="nav-selesai-tab" data-bs-toggle="tab" data-bs-target="#nav-selesai" type="button"
                role="tab" aria-controls="nav-selesai" aria-selected="false">Selesai
                Diverifikasi</button>
        </div>
    </nav>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="nav-menunggu" role="tabpanel" aria-labelledby="nav-menunggu-tab"
            tabindex="0">
            <table class="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hal</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Tanggal Dibuat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratMenungguVerifikasi as $surat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>{{ $surat->asal }}</td>
                            <td>{{ $surat->tujuan }}</td>
                            <td>{{ $surat->tanggalDibuat() }}</td>
                            <td>{{ $surat->status }}</td>
                            <td>
                                <a href="{{ route('surat-keluar.verifikasi.show', ['surat' => $surat]) }}">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade show" id="nav-perbaikan" role="tabpanel" aria-labelledby="nav-perbaikan-tab"
            tabindex="0">
            <table class="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hal</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Tanggal Dibuat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratPerluPerbaikan as $surat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>{{ $surat->asal }}</td>
                            <td>{{ $surat->tujuan }}</td>
                            <td>{{ $surat->tanggalDibuat() }}</td>
                            <td>{{ $surat->status }}</td>
                            <td>
                                <a href="{{ route('surat-keluar.show', ['surat' => $surat]) }}">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade show" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab" tabindex="0">
            <table class="datatable">
                
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hal</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Tanggal Dibuat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratDisetujui as $surat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>{{ $surat->asal }}</td>
                            <td>{{ $surat->tujuan }}</td>
                            <td>{{ $surat->tanggalDibuat() }}</td>
                            <td>{{ $surat->status }}</td>
                            <td>
                                <a href="{{ route('surat-keluar.show', ['surat' => $surat]) }}">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('document').ready(function() {

            $('.datatable').DataTable();
            
        })
    </script>
@endsection
