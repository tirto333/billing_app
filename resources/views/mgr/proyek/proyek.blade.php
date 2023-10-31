@extends('mgr.layouts.master')
@section('title') @lang('translation.projects') @endsection
@section('css')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-4 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Jumlah Projek</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                data-target="{{ $totalProjek }}">{{ $totalProjek }}</span>
                        </h2>
                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                                <i class="ri-ticket-2-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Projek Tetunda</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                data-target="{{ $dataProjectBaru }}">{{ $dataProjectBaru }}</span>
                        </h2>
                        <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-4">
                                <i class="mdi mdi-timer-sand"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Projek Selesai</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">0</span>
                        </h2>
                        <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-4">
                                <i class="ri-checkbox-circle-line"></i>
                            </span>
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
                    <h5 class="card-title mb-0 flex-grow-1">Semua Projek</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <a class="nav-link menu-link" href="{{ route('tambah.proyek.mgr') }}">
                                <button class="btn btn-success add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Buat Projek</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            {{-- <th>No</th> --}}
                            <th>Judul Projek</th>
                            <th>Nama Pelanggan</th>
                            <th>Kepala Projek</th>
                            <th>Projek Dari</th>
                            <th>Status Projek</th>
                            <th>Prioritas</th>
                            <th>Tenggat Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projeks as $key => $data)
                        <tr>
                            {{-- <td class="no">{{ $key + 1 }}</td> --}}
                            <td class="judul_projek"><a href="{{ route('detail.projek.mgr', ['id' => $data->id]) }}"
                                    class="fw-medium link-primary">{{ $data->judul_projek }}{{$data->no_spk}}</a>
                            </td>
                            <td class="pelanggan">{{ $data->pelanggan }}</td>
                            <td class="pelanggan">{{ $data->nm_anggota }}</td>
                            {{-- <td class="kepala_projek">
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
                            </td> --}}
                            {{-- <td class="nama_anggota">
                                <div class="nama_anggota">
                                    @php
                                    $nama_anggota = json_decode($data->nama_anggota);
                                    @endphp
                                    @if ($nama_anggota)
                                    @foreach($nama_anggota as $anggota)
                                    {{ $anggota }}<br>
                                    @endforeach
                                    @else
                                    Data anggota_projek tidak valid.
                                    @endif
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                                        data-bs-trigger="hover" data-bs-placement="top" title="Frank">
                                        {{ $data->nama_anggota }}
                                    </a>
                                </div>
                            </td> --}}
                            <td class="dibuat_oleh">{{ $data->dibuat_oleh }}</td>
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
                            <td class="tenggat_waktu">{{ date('d-m-Y', strtotime($data->tenggat_waktu)) }}</td>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ URL::asset('build/su/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/prismjs/prism.js') }}"></script>

@endsection