@extends('layouts.master')

@section('container')
    <div style="width: 85%;">
        <div class="container bg-white my-3 rounded p-3 shadow">
            <div class="border-bottom border-black">
                <h1 class="ms-3">Agenda Rapat</h1>
            </div>
            <br>
        </div>
        <div class="alert alert-info alert-dismissible fade show mx-4" role="alert">
            Silakan klik untuk melihat detail rapat
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <a href="" class="text-decoration-none text-black">
            <div class="container bg-white my-3 rounded p-3 shadow">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <div>
                        <h4>Rencana Pembangunan Gedung Parkir</h4>
                        <div class="d-flex align-items-center gap-3" style="color: #747474;">
                            <i class="fa-regular fa-calendar-days" style="color: #d9d9d9"></i>
                            Senin, 9 September 2024 | 10:00 - 12:00
                        </div>
                        <div class="d-flex align-items-center gap-3" style="color: #747474;">
                            <i class="fa-solid fa-location-dot" style="color: #d9d9d9"></i>
                            Ruang Sidang
                        </div>
                    </div>
                    <span class="badge rounded-pill text-bg-success py-2 px-4 fs-5" style="width: 112px">Hadir</span>
                </div>
            </div>
        </a>
        <a href="" class="text-decoration-none text-black">
            <div class="container bg-white my-3 rounded p-3 shadow">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <div>
                        <h4>Rencana Pembangunan Gedung Parkir</h4>
                        <div class="d-flex align-items-center gap-3" style="color: #747474;">
                            <i class="fa-regular fa-calendar-days" style="color: #d9d9d9"></i>
                            Senin, 9 September 2024 | 10:00 - 12:00
                        </div>
                        <div class="d-flex align-items-center gap-3" style="color: #747474;">
                            <i class="fa-solid fa-location-dot" style="color: #d9d9d9"></i>
                            Ruang Sidang
                        </div>
                    </div>
                    <span class="badge rounded-pill text-bg-warning text-white py-2 px-4 fs-5"
                        style="width: 112px">Izin</span>
                </div>
            </div>
        </a>
        <a href="" class="text-decoration-none text-black">
            <div class="container bg-white my-3 rounded p-3 shadow">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <div>
                        <h4>Rencana Pembangunan Gedung Parkir</h4>
                        <div class="d-flex align-items-center gap-3" style="color: #747474;">
                            <i class="fa-regular fa-calendar-days" style="color: #d9d9d9"></i>
                            Senin, 9 September 2024 | 10:00 - 12:00
                        </div>
                        <div class="d-flex align-items-center gap-3" style="color: #747474;">
                            <i class="fa-solid fa-location-dot" style="color: #d9d9d9"></i>
                            Ruang Sidang
                        </div>
                    </div>
                    <span class="badge rounded-pill text-bg-danger py-2 px-4 fs-5" style="width: 112px">Notset</span>
                </div>
            </div>
        </a>
    </div>
@endsection
