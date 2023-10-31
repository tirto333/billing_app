@extends('mgr.layouts.master')
@section('title')
@lang('translation.overview')
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mt-n4 mx-n4">
            <div class="bg-warning-subtle">
                <div class="card-body pb-0 px-4">
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="row align-items-center g-3">
                                <div class="col-md-auto">
                                    <div class="avatar-md">
                                        <div class="avatar-title bg-white rounded-circle">
                                            <img src="{{ URL::asset('build/su/images/logo-icon.png') }}" alt=""
                                                class="avatar-xs">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    @foreach ($dataProjek as $data)
                                    <div>
                                        <h4 class="fw-bold">{{ $data->judul_projek}}</h4>
                                        <h4 class="fw-bold">{{ $data->no_spk}}</h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div><i class="ri-building-line align-bottom me-1"></i> {{
                                                $data->pelanggan}}
                                            </div>
                                            <div class="vr"></div>
                                            <div>Tanggal Pembuatan : <span class="fw-medium">{{ date('d F Y',
                                                    strtotime($data->created_at)) }}</span></div>
                                            <div class="vr"></div>
                                            <div>Tenggat Waktu : <span class="fw-medium">{{ date('d F Y',
                                                    strtotime($data->tenggat_waktu)) }}</span></div>
                                            <div class="vr"></div>
                                            <div>
                                                @if ($data->status_projek == 'Baru')
                                                <span
                                                    class="badge rounded-pill border border-secondary text-secondary">Baru</span>
                                                @elseif ($data->status_projek == 'Dalam Proses')
                                                <span
                                                    class="badge rounded-pill border border-warning text-warning">Dalam
                                                    Proses</span>
                                                @elseif ($data->status_projek == 'Tertunda')
                                                <span
                                                    class="badge rounded-pill border border-danger text-danger">Tertunda</span>
                                                @elseif ($data->status_projek == 'Selesai')
                                                <span
                                                    class="badge rounded-pill border border-success text-success">Selesai</span>
                                                @endif<h5>
                                            </div>
                                            <div>
                                                @if ($data->prioritas == 'Rendah')
                                                <span class="badge rounded-pill bg-info fs-12">Sedang</span>
                                                @elseif ($data->prioritas == 'Sedang')
                                                <span class="badge rounded-pill bg-warning fs-12">Sedang</span>
                                                @elseif ($data->prioritas == 'Tinggi')
                                                <span class="badge rounded-pill bg-danger fs-12">Tinggi</span>
                                                @endif<h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview"
                                role="tab">
                                Ringkasan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-activities" role="tab">
                                Aktifitas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-team" role="tab">
                                Tim
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tab-content text-muted">
            <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted">
                                    @foreach ($dataProjek as $data)
                                    <h6 class="mb-3 fw-semibold text-uppercase">Lingkup Projek</h6>
                                    {{ $data->lingkup_projek}}</br></br>
                                    <h6 class="mb-3 fw-semibold text-uppercase">Jenis Projek</h6>
                                    {{ $data->jenis_projek}} | {{ $data->detail_jprojek}}</br></br>
                                    <h6 class="mb-3 fw-semibold text-uppercase">Detail Jenis Projek</h6>
                                    {{ $data->detail_jprojek}}</br></br>
                                    <h6 class="mb-3 fw-semibold text-uppercase">Deskripsi</h6>
                                    {!! htmlspecialchars_decode($data->deskripsi_projek) !!}</br></br>
                                    @endforeach
                                    <div class="pt-3 border-top border-top-dashed mt-4">
                                        <h6 class="mb-3 fw-semibold text-uppercase">Lampiran</h6>
                                        <div class="row g-3">
                                            </br></br></br></br>
                                            <div class="col-xxl-4 col-lg-6">
                                                <div class="border rounded border-dashed p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div
                                                                    class="avatar-title bg-light text-secondary rounded fs-24">
                                                                    <i class="ri-folder-zip-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($detailProjek as $item)
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-13 mb-1"><a
                                                                    href="{{ asset('storage/file/file_projek/' . $item->file) }}"
                                                                    class="text-body text-truncate d-block">{{
                                                                    $item->file }}</a>
                                                            </h5>
                                                            <img src="{{ asset('storage/file/file_projek/' . $item->file) }}"
                                                                alt="{{ $item->file }}">
                                                            <div></div>
                                                        </div>
                                                        @endforeach
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="d-flex gap-1">
                                                                <a href="{{ asset('storage/file/file_projek/1697019909.png') }}"
                                                                    class="text-muted">
                                                                    <i class="ri-download-2-line"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Komentar</h4>
                            </div>
                            <div class="card-body">
                                </br>
                                <div data-simplebar style="height: 300px;" class="px-3 mx-n3 mb-2">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3">
                                            @foreach ($detailProjek as $item)
                                            @if ($item->pesan !== null && $item->penulis !== null)
                                            <h5 class="fs-13">{{ $item->penulis }}<small class="text-muted ms-2">{{
                                                    $item->tgl_komentar }}</small></h5>
                                            <p class="text-muted">{{ $item->pesan }}</p>
                                            {{-- <a href="javascript:void(0);" class="badge text-muted bg-light"
                                                data-toggle="modal" data-target="#replyModal">
                                                <i class="mdi mdi-reply"></i> Balas
                                            </a> --}}
                                            </p>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('simpan.komentarmgr', ['id' => $data->id]) }}" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1" class="form-label text-body">Tulis
                                                Komentar</label>
                                            <textarea class="form-control bg-light border-light"
                                                id="exampleFormControlTextarea1" rows="3"
                                                placeholder="Enter your comment..."></textarea>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button"
                                                class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i
                                                    class="ri-attachment-line fs-16"></i></button>
                                            <a href="javascript:void(0);" class="btn btn-success">Kirim Komentar</a>
                                            <input type="hidden" id="penulis" name="penulis"
                                                value="{{ Auth::user()->user_name }}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-header align-items-center d-flex border-bottom-dashed">
                                <h4 class="card-title mb-0 flex-grow-1">Anggota</h4>
                            </div>
                            <div class="card-body">
                                <div data-simplebar style="height: 235px;" class="mx-n3 px-3">
                                    <div class="vstack gap-3">
                                        @foreach ($kepalaProjek as $data)
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">{{
                                                        $data->nm_anggota }} - {{ $data->posisi }} {{ $data->divisi
                                                        }}</a></h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="d-flex align-items-center gap-1">
                                                    {{-- <button type="button" class="btn btn-light btn-sm">Pesan</button> --}}
                                                    <div class="dropdown">
                                                        <button class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ri-more-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                        class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @foreach ($anggotaProjek as $data)
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">{{
                                                        $data->nm_anggota }} - Staff {{ $data->divisi
                                                        }}</a></h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="d-flex align-items-center gap-1">
                                                    {{-- <button type="button" class="btn btn-light btn-sm">Pesan</button> --}}
                                                    <div class="dropdown">
                                                        <button class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ri-more-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                        class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="project-activities" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Aktifitas</h5>
                        <div class="acitivity-timeline py-3">
                            @foreach ($dataProjek as $item)
                            <div class="acitivity-item d-flex">
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ $item->dibuat_oleh}} <span
                                            class="badge bg-primary-subtle text-primary align-middle">{{
                                            $item->status_projek }}</span></h6>
                                    <p class="text-muted mb-2">Judul Projek {{ $item->no_spk }}{{ $item->judul_projek }}
                                    </p>
                                    <h6 class="mb-1">{{ $item->kepala_projek}}<span
                                            class="badge bg-success-subtle text-success align-middle"></span>
                                    </h6>
                                    <small class="mb-0 text-muted">Waktu {{ $item->created_at }}</small>
                                </div>
                            </div>
                            @endforeach
                            @foreach ($tugasProjek as $item)
                            <div class="acitivity-item py-3 d-flex">
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ $item->tugas_dari }}</h6>
                                    <p class="text-muted mb-2">Menambahkan {{ $item->nm_anggota }} - Staff {{
                                        $item->divisi }}</p>
                                    <small class="mb-0 text-muted">{{ $item->created_at }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="project-team" role="tabpanel">
                <div class="row g-4 mb-3">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm-auto">
                    </div>
                </div>
                <div class="team-list list-view-filter">
                    {{-- @foreach ($anggotaProjek as $data)
                    <div class="card team-box">
                        <div class="card-body px-4">
                            <div class="row align-items-center team-row">
                                <div class="col team-settings">
                                    <div class="row align-items-center">
                                        <div class="col text-end dropdown">
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col">
                                    <div class="team-profile-img">
                                        <div class="team-content">
                                            <a href="#" class="d-block">
                                                <h5 class="fs-16 mb-1">{{ $data->nm_anggota}}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col">
                                    <div class="row text-muted text-center">
                                        <div class="col-6 border-end border-end-dashed">
                                            <h5 class="mb-1">{{ $total }}</h5>
                                            <p class="text-muted mb-0">Projek</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1"></h5>
                                            <p class="text-muted mb-0">Tugas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col">
                                    <div class="text-end">
                                        <a href="pages-profile" class="btn btn-light view-btn">Lihat Profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach --}}
                    @foreach ($kepalaProjek as $data)
                    <div class="card team-box">
                        <div class="card-body px-4">
                            <div class="row align-items-center team-row">
                                <div class="col team-settings">
                                    <div class="row align-items-center">
                                        <div class="col text-end dropdown">
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col">
                                    <div class="team-profile-img">
                                        <div class="team-content">
                                            <a href="#" class="d-block">
                                                <h5 class="fs-16 mb-1">{{ $data->nm_anggota }} - {{$data->posisi}}
                                                    {{$data->divisi}}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col">
                                    <div class="text-end">
                                        <a href="pages-profile" class="btn btn-light view-btn">Lihat Profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach ($anggotaProjek as $data)
                    <div class="card team-box">
                        <div class="card-body px-4">
                            <div class="row align-items-center team-row">
                                <div class="col team-settings">
                                    <div class="row align-items-center">
                                        <div class="col text-end dropdown">
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col">
                                    <div class="team-profile-img">
                                        <div class="team-content">
                                            <a href="#" class="d-block">
                                                <h5 class="fs-16 mb-1">{{ $data->nm_anggota }} - Staff
                                                    {{$data->divisi}}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col">
                                    <div class="text-end">
                                        <a href="pages-profile" class="btn btn-light view-btn">Lihat Profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('build/su/js/pages/project-overview.init.js') }}"></script>
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection