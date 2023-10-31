@extends('emp.layouts.master')
@section('title') Dashboard @endsection
@section('css')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
{{--
<link rel="stylesheet" href="{{ URL::asset('build/su/libs/gridjs/theme/mermaid.min.css') }}"> --}}
@endsection
@section('content')

{{-- @component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Projects @endslot
@endcomponent --}}
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
                                    Tugas Aktif</p>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="{{ $tProjek }}">{{ $tProjek }}</span></h4>
                                </div>
                                <p class="text-muted text-truncate mb-0">Tugas Bulan Ini</p>
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
        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Ulasan Proyek</h4>
                        <div>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                Semua
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1Y
                            </button>
                        </div>
                    </div>
                    <div class="card-header p-0 border-0 bg-light-subtle">
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="">0</span></h5>
                                    <p class="text-dark mb-0">Jumlah Proyek</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1 text-info"><span class="counter-value" data-target="">0</span>
                                    </h5>
                                    <p class="text-info mb-0 ">Proyek Aktif</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1 text-success"><span class="counter-value" data-target="">0</span>
                                    </h5>
                                    <p class="text-success mb-0">Proyek Selesai</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                    <h5 class="mb-1 text-danger"><span class="counter-value" data-target="">0</span>
                                    </h5>
                                    <p class="text-danger mb-0">Proyek Tertunda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 pb-2">
                        <div>
                            <div id="projects-overview-chart"
                                data-colors='["--vz-dark", "--vz-info", "--vz-success", "--vz-danger"]' dir="ltr"
                                class="apex-charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="col-xxl-4">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title mb-0">Jadwal Mendatang</h4>
            </div>
            <div class="card-body pt-0">
                <div class="upcoming-scheduled">
                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"
                        data-deafult-date="today" data-inline-date="true">
                </div>

                <h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted">Acara:</h6>
                <div class="mini-stats-wid d-flex align-items-center mt-3">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="mini-stat-icon avatar-title rounded-circle text-success bg-success-subtle fs-4">
                            09
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Development planning</h6>
                        <p class="text-muted mb-0">iTest Factory </p>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="text-muted mb-0">9:20 <span class="text-uppercase">am</span></p>
                    </div>
                </div>
                <div class="mini-stats-wid d-flex align-items-center mt-3">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="mini-stat-icon avatar-title rounded-circle text-success bg-success-subtle fs-4">
                            12
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Design new UI and check sales</h6>
                        <p class="text-muted mb-0">Meta4Systems</p>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="text-muted mb-0">11:30 <span class="text-uppercase">am</span></p>
                    </div>
                </div>
                <div class="mini-stats-wid d-flex align-items-center mt-3">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="mini-stat-icon avatar-title rounded-circle text-success bg-success-subtle fs-4">
                            25
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Weekly catch-up </h6>
                        <p class="text-muted mb-0">Nesta Technologies</p>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="text-muted mb-0">02:00 <span class="text-uppercase">pm</span></p>
                    </div>
                </div>
                <div class="mini-stats-wid d-flex align-items-center mt-3">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="mini-stat-icon avatar-title rounded-circle text-success bg-success-subtle fs-4">
                            27
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">James Bangs (Client) Meeting</h6>
                        <p class="text-muted mb-0">Nesta Technologies</p>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="text-muted mb-0">03:45 <span class="text-uppercase">pm</span></p>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <a href="javascript:void(0);" class="text-muted text-decoration-underline">Lihat Semua Acara</a>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title flex-grow-1 mb-0">Projek Aktif</h4>
                <div class="flex-shrink-0">
                    {{-- <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export Report</a> --}}
                </div>
            </div>
            <div class="card-body">
                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nama Proyek</th>
                            <th scope="col">Kepala Proyek</th>
                            <th scope="col">Perkembangan</th>
                            <th scope="col">Status Projek</th>
                            <th scope="col">Prioritas</th>
                            <th scope="col" style="width: 10%;">Waktu Dibuat</th>
                            <th scope="col" style="width: 10%;">Tenggat Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataProject as $data)
                        <tr>
                            <td class="fw-medium">{{ $data->projek_tugas }}</td>
                            <td class="fw-medium">{{ $data->tugas_dari }}
                            </td>
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
                            <td>
                                @if ($data->status_tugas == 'Baru')
                                <span class="badge bg-info-subtle text-info text-uppercase">Baru</span>
                                @elseif ($data->status_tugas == 'Dalam Proses')
                                <span class="badge bg-secondary-subtle text-secondary text-uppercase">Dalam
                                    Proses</span>
                                @elseif ($data->status_tugas == 'Tertunda')
                                <span class="badge bg-danger-subtle text-danger text-uppercase">Tertunda</span>
                                @elseif ($data->status_tugas == 'Selesai')
                                <span class="badge bg-success-subtle text-success text-uppercase">Selesai</span>
                                @endif<h5>
                            </td>
                            <td class="prioritas_tugas">
                                @if ($data->prioritas_tugas == 'Rendah')
                                <span class="badge bg-info text-uppercase">Sedang</span>
                                @elseif ($data->prioritas_tugas == 'Sedang')
                                <span class="badge bg-warning text-uppercase">Sedang</span>
                                @elseif ($data->prioritas_tugas == 'Tinggi')
                                <span class="badge bg-danger text-uppercase">Tinggi</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            <td class="text-muted">{{ date('d-m-Y', strtotime($data->tenggat_waktu)) }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-xxl-4">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Status Proyek</h4>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="dropdown-btn text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Semua Waktu <i class="mdi mdi-chevron-down ms-1"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Semua Waktu</a>
                            <a class="dropdown-item" href="#">7 Hari Terakhir</a>
                            <a class="dropdown-item" href="#">30 Hari Terakhir</a>
                            <a class="dropdown-item" href="#">90 Hari Terakhir</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="prjects-status" data-colors='["--vz-success", "--vz-primary", "--vz-warning", "--vz-danger"]'
                    class="apex-charts" dir="ltr"></div>
                <div class="mt-3">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h2 class="me-3 ff-secondary mb-0">0</h2>
                        <div>
                            <p class="text-muted mb-0">Total Proyek</p>
                            <p class="text-success fw-medium mb-0">
                                <span class="badge bg-success-subtle text-success p-1 rounded-circle"><i
                                        class="ri-arrow-right-up-line"></i></span> +0 baru
                            </p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                        <p class="fw-medium mb-0"><i
                                class="ri-checkbox-blank-circle-fill text-success align-middle me-2"></i>Selesai</p>
                        <div>
                            <span class="text-muted pe-5">0 Proyek</span>
                            <span class="text-success fw-medium fs-12">0 Jam</span>
                        </div>
                    </div><!-- end -->
                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                        <p class="fw-medium mb-0"><i
                                class="ri-checkbox-blank-circle-fill text-primary align-middle me-2"></i>
                            Sedang Proses</p>
                        <div>
                            <span class="text-muted pe-5">0 Proyek</span>
                            <span class="text-success fw-medium fs-12">0 Jam</span>
                        </div>
                    </div><!-- end -->
                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                        <p class="fw-medium mb-0"><i
                                class="ri-checkbox-blank-circle-fill text-warning align-middle me-2"></i>
                            Belum Dimulai</p>
                        <div>
                            <span class="text-muted pe-5">0 Proyek</span>
                            <span class="text-success fw-medium fs-12">0 Jam</span>
                        </div>
                    </div><!-- end -->
                    <div class="d-flex justify-content-between py-2">
                        <p class="fw-medium mb-0"><i
                                class="ri-checkbox-blank-circle-fill text-danger align-middle me-2"></i>
                            Dibatalkan</p>
                        <div>
                            <span class="text-muted pe-5">0 Proyek</span>
                            <span class="text-success fw-medium fs-12">0 Jam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
<script src="{{ URL::asset('build/su/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/apexcharts/apexcharts.min.js') }}"></script>
{{-- <script src="{{ URL::asset('build/su/js/pages/dashboard-projects.init.js') }}"></script> --}}
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection