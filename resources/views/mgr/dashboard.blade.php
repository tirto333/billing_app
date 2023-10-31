@extends('mgr.layouts.master')
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
                                            data-target="{{ $tProjek }}">{{ $tProjek }}</span>
                                    </h4>
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
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title flex-grow-1 mb-0">Projek Aktif</h4>
                <div class="flex-shrink-0">
                </div>
            </div>
            <div class="card-body">
                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nama Proyek</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Kepala Proyek</th>
                            {{-- <th scope="col">Anggota Projek</th> --}}
                            <th scope="col">Status Projek</th>
                            <th scope="col">Prioritas Projek</th>
                            <th scope="col" style="width: 10%;">Waktu Dibuat</th>
                            <th scope="col" style="width: 10%;">Tenggat Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projeks as $data)
                        <tr>
                            <td class="judul_projek"><a href="{{ route('detail.projek.mgr', ['id' => $data->id]) }}"
                                    class="fw-medium link-primary">{{ $data->judul_projek }}{{$data->no_spk}}</a></td>
                            <td class="pelanggan">{{ $data->pelanggan }}</td>
                            {{-- <td class="pelanggan">{{ $data->nm_anggota }}</td> --}}
                            <td class="kepala_projek">
                                {{-- <img src="" class="avatar-xxs rounded-circle me-1" alt=""> --}}
                                @php
                                $kepala_projek = json_decode($data->kepala_projek);
                                @endphp
                                @if (is_array($kepala_projek) || is_object($kepala_projek))
                                @foreach($kepala_projek as $kepala)
                                {{ $kepala }}<br>
                                @endforeach
                                @else
                                {{ $kepala_projek }}<br>
                                @endif
                            </td>
                            {{-- <td class="nama_anggota">
                                @php
                                $nama_anggota = json_decode($data->nama_anggota);
                                @endphp
                                @if (is_array($nama_anggota) || is_object($nama_anggota))
                                @foreach($nama_anggota as $anggota)
                                {{ $anggota }}<br>
                                @endforeach
                                @else
                                {{ $nama_anggota }}<br>
                                @endif
                            </td> --}}
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title flex-grow-1 mb-0">Tugas Aktif</h4>
                <div class="flex-shrink-0">
                </div>
            </div>
            <div class="card-body">
                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nama Tugas</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Tugas Dari</th>
                            <th scope="col">Ditujukan Kepada</th>
                            <th scope="col">Status Tugas</th>
                            <th scope="col">Prioritas Tugas</th>
                            <th scope="col" style="width: 10%;">Waktu Dibuat</th>
                            <th scope="col">Tenggat Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($dataProject as $data)
                        <tr>
                            <td class="nm_pelanggan"><a href="{{ route('detail.tugas.mgr', ['id' => $data->id]) }}"
                                    class="fw-medium link-primary">{{ $data->judul_projek }}</a></td>
                            <td class="nama_projek"></a>{{ $data->pelanggan }}</td>
                            <td class="kepala_projek"></a>
                                @php
                                $kepala_projek = json_decode($data->kepala_projek);
                                @endphp
                                @if ($kepala_projek)
                                @foreach($kepala_projek as $head)
                                {{ $head }}<br>
                                @endforeach
                                @endif
                            </td>
                            <td class="ditugaskan">
                                @php
                                $nama_anggota = json_decode($data->nama_anggota);
                                @endphp
                                @if ($nama_anggota)
                                @foreach($nama_anggota as $anggota)
                                {{ $anggota }}<br>
                                @endforeach
                                @endif
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
                                @endif
                            </td>
                            <td class="prioritas">
                                @if ($data->prioritas == 'Rendah')
                                <span class="badge bg-info text-uppercase">Sedang</span>
                                @elseif ($data->prioritas == 'Sedang')
                                <span class="badge bg-warning text-uppercase">Sedang</span>
                                @elseif ($data->prioritas == 'Tinggi')
                                <span class="badge bg-danger text-uppercase">Tinggi</span>
                                @endif
                            </td>

                            <td class="tenggat_waktu">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            <td class="tenggat_waktu">{{ date('d-m-Y', strtotime($data->tenggat_waktu)) }}</td>
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="row">
    <div class="col-xxl-4">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Anggota Tim</h4>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="fw-semibold text-uppercase fs-12">Sotir: </span><span class="text-muted">30
                                Hari Terakhir<i class="mdi mdi-chevron-down ms-1"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Hari Ini</a>
                            <a class="dropdown-item" href="#">Kemarin</a>
                            <a class="dropdown-item" href="#">7 Hari Terakhir</a>
                            <a class="dropdown-item" href="#">30 Hari Terakhir</a>
                            <a class="dropdown-item" href="#">Bulan Ini</a>
                            <a class="dropdown-item" href="#">Bulan Lalu</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless table-nowrap align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">Anggota</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Tugas</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-flex">
                                    <img src="{{ URL::asset('build/su/images/users/avatar-1.jpg') }}" alt=""
                                        class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">Donald Risher</h5>
                                        <p class="fs-12 mb-0 text-muted">Product Manager</p>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0">110h : <span class="text-muted">150h</span>
                                    </h6>
                                </td>
                                <td>
                                    258
                                </td>
                                <td style="width:5%;">
                                    <div id="radialBar_chart_1" data-colors='["--vz-primary"]' data-chart-series="50"
                                        class="apex-charts" dir="ltr"></div>
                                </td>
                            </tr>>
                            <tr>
                                <td class="d-flex">
                                    <img src="{{ URL::asset('build/su/images/users/avatar-2.jpg') }}" alt=""
                                        class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">Jansh Brown</h5>
                                        <p class="fs-12 mb-0 text-muted">Lead Developer</p>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0">83h : <span class="text-muted">150h</span></h6>
                                </td>
                                <td>
                                    105
                                </td>
                                <td>
                                    <div id="radialBar_chart_2" data-colors='["--vz-primary"]' data-chart-series="45"
                                        class="apex-charts" dir="ltr"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex">
                                    <img src="{{ URL::asset('build/su/images/users/avatar-7.jpg') }}" alt=""
                                        class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">Carroll Adams</h5>
                                        <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0">58h : <span class="text-muted">150h</span></h6>
                                </td>
                                <td>
                                    75
                                </td>
                                <td>
                                    <div id="radialBar_chart_3" data-colors='["--vz-primary"]' data-chart-series="75"
                                        class="apex-charts" dir="ltr"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex">
                                    <img src="{{ URL::asset('build/su/images/users/avatar-4.jpg') }}" alt=""
                                        class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">William Pinto</h5>
                                        <p class="fs-12 mb-0 text-muted">UI/UX Designer</p>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0">96h : <span class="text-muted">150h</span></h6>
                                </td>
                                <td>
                                    85
                                </td>
                                <td>
                                    <div id="radialBar_chart_4" data-colors='["--vz-warning"]' data-chart-series="25"
                                        class="apex-charts" dir="ltr"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex">
                                    <img src="{{ URL::asset('build/su/images/users/avatar-6.jpg') }}" alt=""
                                        class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">Garry Fournier</h5>
                                        <p class="fs-12 mb-0 text-muted">Web Designer</p>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0">76h : <span class="text-muted">150h</span></h6>
                                </td>
                                <td>
                                    69
                                </td>
                                <td>
                                    <div id="radialBar_chart_5" data-colors='["--vz-primary"]' data-chart-series="60"
                                        class="apex-charts" dir="ltr"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex">
                                    <img src="{{ URL::asset('build/su/images/users/avatar-5.jpg') }}" alt=""
                                        class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">Susan Denton</h5>
                                        <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                    </div>
                                </td>

                                <td>
                                    <h6 class="mb-0">123h : <span class="text-muted">150h</span>
                                    </h6>
                                </td>
                                <td>
                                    658
                                </td>
                                <td>
                                    <div id="radialBar_chart_6" data-colors='["--vz-success"]' data-chart-series="85"
                                        class="apex-charts" dir="ltr"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex">
                                    <img src="{{ URL::asset('build/su/images/users/avatar-3.jpg') }}" alt=""
                                        class="avatar-xs rounded-3 me-2">
                                    <div>
                                        <h5 class="fs-13 mb-0">Joseph Jackson</h5>
                                        <p class="fs-12 mb-0 text-muted">React Developer</p>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0">117h : <span class="text-muted">150h</span>
                                    </h6>
                                </td>
                                <td>
                                    125
                                </td>
                                <td>
                                    <div id="radialBar_chart_7" data-colors='["--vz-primary"]' data-chart-series="70"
                                        class="apex-charts" dir="ltr"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
    <div class="col-xxl-4">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1 py-1">Tugas Saya</h4>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="text-muted">Semua Tugas<i class="mdi mdi-chevron-down ms-1"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Semua Tugas</a>
                            <a class="dropdown-item" href="#">Selesai</a>
                            <a class="dropdown-item" href="#">Sedang Berlangsung</a>
                            <a class="dropdown-item" href="#">Tertunda</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless table-nowrap table-centered align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Tenggat Waktu</th>
                                <th scope="col">Status</th>
                                <th scope="col">Penerima Tugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask1">
                                        <label class="form-check-label ms-1" for="checkTask1">
                                            Create new Admin Template
                                        </label>
                                    </div>
                                </td>
                                <td class="text-muted">03 Nov 2021</td>
                                <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                                <td>
                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="" data-bs-original-title="Mary Stoner">
                                        <img src="{{ URL::asset('build/su/images/users/avatar-2.jpg') }}" alt=""
                                            class="rounded-circle avatar-xxs">
                                    </a>
                                </td>
                            </tr><!-- end -->
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask2">
                                        <label class="form-check-label ms-1" for="checkTask2">
                                            Marketing Coordinator
                                        </label>
                                    </div>
                                </td>
                                <td class="text-muted">17 Nov 2021</td>
                                <td><span class="badge bg-warning-subtle text-warning">Progress</span></td>
                                <td>
                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="" data-bs-original-title="Den Davis">
                                        <img src="{{ URL::asset('build/su/images/users/avatar-7.jpg') }}" alt=""
                                            class="rounded-circle avatar-xxs">
                                    </a>
                                </td>
                            </tr><!-- end -->
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask3">
                                        <label class="form-check-label ms-1" for="checkTask3">
                                            Administrative Analyst
                                        </label>
                                    </div>
                                </td>
                                <td class="text-muted">26 Nov 2021</td>
                                <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                                <td>
                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="" data-bs-original-title="Alex Brown">
                                        <img src="{{ URL::asset('build/su/images/users/avatar-6.jpg') }}" alt=""
                                            class="rounded-circle avatar-xxs">
                                    </a>
                                </td>
                            </tr><!-- end -->
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask4">
                                        <label class="form-check-label ms-1" for="checkTask4">
                                            E-commerce Landing Page
                                        </label>
                                    </div>
                                </td>
                                <td class="text-muted">10 Dec 2021</td>
                                <td><span class="badge bg-danger-subtle text-danger">Pending</span></td>
                                <td>
                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="" data-bs-original-title="Prezy Morin">
                                        <img src="{{ URL::asset('build/su/images/users/avatar-5.jpg') }}" alt=""
                                            class="rounded-circle avatar-xxs">
                                    </a>
                                </td>
                            </tr><!-- end -->
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask5">
                                        <label class="form-check-label ms-1" for="checkTask5">
                                            UI/UX Design
                                        </label>
                                    </div>
                                </td>
                                <td class="text-muted">22 Dec 2021</td>
                                <td><span class="badge bg-warning-subtle text-warning">Progress</span></td>
                                <td>
                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                        <img src="{{ URL::asset('build/su/images/users/avatar-1.jpg') }}" alt=""
                                            class="rounded-circle avatar-xxs">
                                    </a>
                                </td>
                            </tr><!-- end -->
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask6">
                                        <label class="form-check-label ms-1" for="checkTask6">
                                            Projects Design
                                        </label>
                                    </div>
                                </td>
                                <td class="text-muted">31 Dec 2021</td>
                                <td><span class="badge bg-danger-subtle text-danger">Pending</span></td>
                                <td>
                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="" data-bs-original-title="Jansh William">
                                        <img src="{{ URL::asset('build/su/images/users/avatar-4.jpg') }}" alt=""
                                            class="rounded-circle avatar-xxs">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3 text-center">
                <a href="javascript:void(0);" class="text-muted text-decoration-underline">Lihat Lebih</a>
            </div>
            </br>
        </div>
    </div>
</div> --}}
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