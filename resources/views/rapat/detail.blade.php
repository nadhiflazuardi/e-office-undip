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
    <h1>Detail Rapat</h1>
    <hr>
    <form action="{{ route('rapat.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judulInput" class="form-label">Judul</label>
            <input disabled class="form-control @error('judul') is-invalid @enderror" type="text" name="judul" id="judulInput"
                value="{{ $rapat->judul }}">
            @error('judul')
                <label for="judulInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <label for="perihalInput" class="form-label" value="{{ old('perihal') }}">Perihal</label>
            <input disabled class="form-control @error('perihal') is-invalid @enderror" type="text" name="perihal"
                id="perihalInput" value="{{ $rapat->perihal }}">
            @error('perihal')
                <label for="perihalInput" class="invalid-feedback">{{ $message }}</label>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="tanggalInput" class="form-label ">Tanggal</label>
                <input disabled class="form-control  @error('tanggal') is-invalid @enderror" type="date" name="tanggal"
                    id="tanggalInput" value="{{ $rapat->tanggal() }}">
                @error('tanggal')
                    <label for="tanggalInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col">
                <label for="tempatInput" class="form-label">Tempat</label>
                <input disabled class="form-control @error('tempat') is-invalid @enderror" type="text" name="tempat"
                    id="tempatInput" value="{{ $rapat->tempat }}">
                @error('tempat')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="waktuMulaiInput" class="form-label ">Waktu Mulai</label>
                <input disabled class="form-control @error('waktuMulai') is-invalid @enderror" type="time" name="waktuMulai"
                    id="waktuMulaiInput" value="{{ $rapat->waktuMulai() }}">
                @error('waktuMulai')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col">
                <label for="pimpinanInput" class="form-label">Pimpinan Rapat</label>
                <select disabled class="form-select @error('pemimpinRapat') is-invalid @enderror" name="pemimpinRapat"
                    id="pimpinanInput">
                    <option value="">Pilih Pimpinan</option>
                    @foreach ($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}" @selected($rapat->pemimpin_rapat_id == $pegawai->id)>{{ $pegawai->nama }}</option>
                    @endforeach
                </select>
                @error('pemimpinRapat')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="waktuSelesaiInput" class="form-label ">Waktu Selesai</label>
                <input disabled class="form-control @error('waktuSelesai') is-invalid @enderror" type="time" name="waktuSelesai"
                    id="waktuSelesaiInput" value="{{ $rapat->waktuSelesai() }}">
                @error('waktuSelesai')
                    <label for="tempatInput" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="col">
                <label for="color-selection" class="mb-3">Pilih Warna Label Rapat</label>
                <div class="mb-3" id="color-selection">
                    <div class="form-check form-check-inline">
                        <input disabled class="form-check-input" type="radio" name="warnaLabel" id="editColorRed" value="#d50000"
                            @checked($rapat->warna_label == '#d50000')>
                        <label class="form-check-label" for="editColorRed">
                            <span class="color-sample" style="background-color: #d50000;"></span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input disabled class="form-check-input" type="radio" name="warnaLabel" id="editColorBlue" value="#039ae5"
                            @checked($rapat->warna_label == '#039ae5')>
                        <label class="form-check-label" for="editColorBlue">
                            <span class="color-sample" style="background-color: #039ae5;"></span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input disabled class="form-check-input" type="radio" name="warnaLabel" id="editColorGreen"
                            value="#33b679" @checked($rapat->warna_label == '#33b679')>
                        <label class="form-check-label" for="editColorGreen">
                            <span class="color-sample" style="background-color: #33b679;"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <label for="pesertaTable" class="form-label fs-4">Pilih Peserta Rapat</label>
        <div class="">
            <label for="selectAll" class="form-label">Pilih Semua</label>
            <input disabled type="checkbox" id="selectAll">
            <input disabled type="hidden" id="semuaPesertaInput">
        </div>
        @error('pesertaRapat')
            <label for="selectAll" class="form-label" style="color: red">{{ $message }}</label>
        @enderror
        <table id="pesertaTable" class="display">
            <thead>
                <tr>
                    <th>Pilih Semua</th>
                    <th>Nama Pegawai</th>
                    <th>NIP</th>
                    <th>Unit Kerja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawais as $pegawai)
                    <tr>
                        <td><input disabled type="checkbox" class="pesertaCheckbox" name="pesertaRapat[]"
                                value="{{ $pegawai->id }}" @checked($pesertas->contains('pegawai_id', $pegawai->id))></td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->unitKerja->nama }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#pesertaTable').DataTable();

        });

        $('#selectAll').on('click', function() {
            var semuaPeserta = @json(
                $pegawais->map(function ($pegawai) {
                    return $pegawai->id;
                }));

            console.log(semuaPeserta);

            $('.pesertaCheckbox').prop('disabled', this.checked);
            if (this.checked) {
                $('.pesertaHidden').remove();
                semuaPeserta.forEach(peserta => {
                    $('#semuaPesertaInput').after(
                        `<input disabled type="hidden" class="pesertaHidden" name="pesertaRapat[]" value="${peserta}">`
                    );
                });
            } else {
                $('.pesertaHidden').remove();
            }
        });

        // Update status "Select All" saat checkbox individual berubah
        $('.pesertaCheckbox').on('click', function() {
            if ($('.pesertaCheckbox:checked').length == $('.pesertaCheckbox').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });
    </script>
@endsection
