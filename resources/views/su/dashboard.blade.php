@extends('su.layouts.master')
@section('title') Dashboard @endsection
@section('css')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row project-wrapper">
    <div class="col-xxl-8">
        <div class="row">
            <div class="col-xl-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                    <i data-feather="briefcase" class="text-primary"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-3">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    Projek Aktif</p>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="{{ $tProjek }}">{{ $tProjek }}</h4>
                                </div>
                                <p class="text-muted text-truncate mb-0">Proyek Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                    <i data-feather="award" class="text-warning"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium text-muted mb-3">Agenda Hari Ini</p>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="">0</span></h4>
                                </div>
                                <p class="text-muted mb-0">Agenda Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                    <i data-feather="clock" class="text-info"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-3">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    Laporan Hari Ini</p>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="">0</span>
                                </div>
                                <p class="text-muted text-truncate mb-0">Total Laporan Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Projek Aktif</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <a class="nav-link menu-link" href="{{ route('tambah.proyek') }}">
                                <button class="btn btn-success add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Buat Projek</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table accordion" id="buttons-datatables" class="display table table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Judul Proyek</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Kepala Proyek</th>
                            <th scope="col">Perkembangan</th>
                            <th scope="col">Status Projek</th>
                            <th scope="col">Prioritas Projek</th>
                            <th scope="col" style="width: 10%;">Waktu Dibuat</th>
                            <th scope="col" style="width: 10%;">Tenggat Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projeks as $index => $data)
                        <tr data-bs-toggle="collapse" data-bs-target="#r1{{ $index }}" class="clickable-row">
                            <td class="fw-medium">{{ $data->judul_projek }} {{ $data->no_spk}}</td>
                            <td class="fw-medium">{{ $data->pelanggan }}</td>
                            <td class="fw-medium">{{ $data->dibuat_oleh }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-1 text-muted fs-13">53%</div>
                                    <div class="progress progress-sm  flex-grow-1" style="width: 68%;">
                                        <div class="progress-bar bg-primary rounded" role="progressbar"
                                            style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="status_projek">
                                @if ($data->status_projek == 'Baru')
                                <span class="badge bg-info-subtle text-info text-uppercase">Baru</span>
                                @elseif ($data->status_projek == 'Dalam Proses')
                                <span class="badge bg-secondary-subtle text-secondary text-uppercase">Dalam
                                    Proses</span>
                                @elseif ($data->status_projek == 'Tertunda')
                                <span class="badge bg-danger-subtle text-danger text-uppercase">Tertunda</span>
                                @elseif ($data->status_projek == 'Selesai')
                                <span class="badge bg-success-subtle text-success text-uppercase">Selesai</span>
                                @endif<h5>
                            </td>
                            <td class="prioritas">
                                @if ($data->prioritas == 'Rendah')
                                <span class="badge bg-info text-uppercase">Sedang</span>
                                @elseif ($data->prioritas == 'Sedang')
                                <span class="badge bg-warning text-uppercase">Sedang</span>
                                @elseif ($data->prioritas == 'Tinggi')
                                <span class="badge bg-danger text-uppercase">Tinggi</span>
                                @endif<h5>
                            </td>
                            <td class="created_at">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            <td class="tengat_waktu">{{ date('d-m-Y', strtotime($data->tenggat_waktu)) }}</td>
                        </tr>
                        <tr class="collapse accordion-collapse" id="r1{{ $index }}">
                            <td colspan="8">
                                <div class="card-body">
                                    <h5>Daftar Tugas</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Anggota Projek</th>
                                                <th scope="col">Deskripsi Tugas</th>
                                                <th scope="col">Kepala Proyek</th>
                                                <th scope="col">Perkembangan</th>
                                                <th scope="col">Status Projek</th>
                                                <th scope="col">Prioritas Projek</th>
                                                <th scope="col" style="width: 10%;">Waktu Dibuat</th>
                                                <th scope="col" style="width: 10%;">Tenggat Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tugasAnggotas as $tugasanggota)
                                            @if ($tugasanggota->projek_tugas === $data->no_spk)
                                            <tr>
                                                <td>
                                                    @php
                                                    $ditugaskan = json_decode($tugasanggota->ditugaskan);
                                                    @endphp
                                                    @if (is_array($ditugaskan) || is_object($ditugaskan))
                                                    @foreach($ditugaskan as $anggota)
                                                    {{ $anggota }}<br>
                                                    @endforeach
                                                    @else
                                                    {{ $ditugaskan }}<br>
                                                    @endif
                                                </td>
                                                <td>{!! htmlspecialchars_decode($tugasanggota->deskripsi_tugas) !!}</td>
                                                <td>{{ $tugasanggota->tugas_dari }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-1 text-muted fs-13">53%</div>
                                                        <div class="progress progress-sm  flex-grow-1" style="width: 68%;">
                                                            <div class="progress-bar bg-primary rounded" role="progressbar"
                                                                style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="status_projek">
                                                    @if ($tugasanggota->status_tugas == 'Baru')
                                                    <span class="badge bg-info-subtle text-info text-uppercase">Baru</span>
                                                    @elseif ($tugasanggota->status_tugas == 'Dalam Proses')
                                                    <span class="badge bg-secondary-subtle text-secondary text-uppercase">Dalam
                                                        Proses</span>
                                                    @elseif ($tugasanggota->status_tugas == 'Tertunda')
                                                    <span class="badge bg-danger-subtle text-danger text-uppercase">Tertunda</span>
                                                    @elseif ($tugasanggota->status_tugas == 'Selesai')
                                                    <span class="badge bg-success-subtle text-success text-uppercase">Selesai</span>
                                                    @endif<h5>
                                                </td>
                                                <td class="prioritas">
                                                    @if ($tugasanggota->prioritas_tugas == 'Rendah')
                                                    <span class="badge bg-info text-uppercase">Sedang</span>
                                                    @elseif ($tugasanggota->prioritas_tugas == 'Sedang')
                                                    <span class="badge bg-warning text-uppercase">Sedang</span>
                                                    @elseif ($tugasanggota->prioritas_tugas == 'Tinggi')
                                                    <span class="badge bg-danger text-uppercase">Tinggi</span>
                                                    @endif<h5>
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($tugasanggota->created_at)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($tugasanggota->tengat_waktu)) }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(".clickable-row").click(function() {
            var target = $(this).data("target");
            $(target).collapse("toggle");
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="{{ URL::asset('build/su/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection