@extends('emp.layouts.master')
@section('title') @lang('translation.task-details') @endsection
@section('content')

<div class="row">
    <div class="col-xxl-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title mb-3 flex-grow-1 text-start">Pelacakan Waktu</h6>
                <div class="mb-2">
                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop"
                        colors="primary:#405189,secondary:#02a8b5" style="width:90px;height:90px">
                    </lord-icon>
                </div>
                @foreach ($dataTugas as $data)
                @php
                $date = Carbon\Carbon::parse($data->created_at);
                @endphp
                <h3 class="mb-1">Telah Dibuat pada</h3>
                <h5 class="mb-1">{{ $date->diffForHumans(['parts' => 2]) }}</h5>
                {{-- <h5 class="fs-14 mb-4">Profile Page Structure</h5>
                <div class="hstack gap-2 justify-content-center">
                    <button class="btn btn-danger btn-sm"><i class="ri-stop-circle-line align-bottom me-1"></i>
                        Stop</button>
                    <button class="btn btn-success btn-sm"><i class="ri-play-circle-line align-bottom me-1"></i>
                        Start</button>
                </div> --}}
                @endforeach
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-4">\
                    @foreach ($dataTugas as $data)
                    <select class="form-control" name="status_tugas" id="status_tugas" data-choices
                        data-choices-search-false required oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                        oninput="setCustomValidity('')">
                        <option value="{{ $data->status_tugas }}">{{ $data->status_tugas }}</option>
                        <option value="Baru">Baru</option>
                        <option value="Dalam Proses">Dalam Proses</option>
                        <option value="Tertunda">Tertunda</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    @endforeach
                </div>
                <div class="table-card">
                    <table class="table mb-0">
                        <tbody>
                            @foreach ($dataTugas as $data)
                            <tr>
                                <td class="fw-medium">Judul Tugas</td>
                                <td> {{ $data->projek_tugas }}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Prioritas</td>
                                <td>
                                    @if ($data->prioritas_tugas == 'Rendah')
                                    <span class="badge bg-info-subtle text-info">Sedang</span>
                                    @elseif ($data->prioritas_tugas == 'Sedang')
                                    <span class="badge bg-warning-subtle text-warning">Sedang</span>
                                    @elseif ($data->prioritas_tugas == 'Tinggi')
                                    <span class="badge bg-danger-subtle text-danger">Tinggi</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Status Tugas</td>
                                <td>
                                    @if ($data->status_tugas == 'Baru')
                                    <span class="badge bg-info-subtle text-info">Baru</span>
                                    @elseif ($data->status_tugas == 'Dalam Proses')
                                    <span class="badge bg-secondary-subtle text-secondary">Dalam
                                        Proses</span>
                                    @elseif ($data->status_tugas == 'Tertunda')
                                    <span class="badge bg-danger-subtle text-danger">Tertunda</span>
                                    @elseif ($data->status_tugas == 'Selesai')
                                    <span class="badge bg-success-subtle text-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Tenggat Waktu</td>
                                <td>{{ date('d F Y', strtotime($data->tenggat_waktu)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h6 class="card-title mb-0 flex-grow-1">Ditugaskan Kepada</h6>
                    <div class="flex-shrink-0">
                    </div>
                </div>
                <ul class="list-unstyled vstack gap-3 mb-0">
                    <li>
                        @foreach ($tugasUntuk as $data)
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-1"><a href="pages-profile">{{ $data->penerima_tugas }}</a></h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-sm fs-16 text-muted dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </ul>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h6 class="card-title mb-0 flex-grow-1">Dibuat Oleh</h6>
                    <div class="flex-shrink-0">
                    </div>
                </div>
                <ul class="list-unstyled vstack gap-3 mb-0">
                    <li>
                        @foreach ($megetahui as $data)
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-1"><a href="pages-profile">{{ $data->tugas_dari }}</a></h6>
                                {{-- <p class="text-muted mb-0"></p> --}}
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-sm fs-16 text-muted dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </ul>
            </div>
        </div>
        {{-- <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h6 class="card-title mb-0 flex-grow-1">Dibuat Oleh</h6>
                    <div class="flex-shrink-0">
                    </div>
                </div>
                <ul class="list-unstyled vstack gap-3 mb-0">
                    <li>
                        @foreach ($dataTugas as $data)
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-1"><a href="pages-profile">{{ $data->mengetahui }}</a></h6>
                                <p class="text-muted mb-0"></p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-sm fs-16 text-muted dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-eye-fill text-muted me-2 align-bottom"></i>Lihat</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </ul>
            </div>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Lampiran</h5>
                <div class="vstack gap-2">
                    {{-- <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-folder-zip-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="javascript:void(0);"
                                        class="text-body text-truncate d-block">App pages.zip</a></h5>
                                <div>2.2MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i
                                            class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rename</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-file-ppt-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="javascript:void(0);"
                                        class="text-body text-truncate d-block">Velzon admin.ppt</a></h5>
                                <div>2.4MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i
                                            class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rename</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-folder-zip-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="javascript:void(0);"
                                        class="text-body text-truncate d-block">Images.zip</a></h5>
                                <div>1.2MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i
                                            class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rename</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="mt-2 text-center">
                        <button type="button" class="btn btn-success">Selengkapnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-semibold text-uppercase">Deskripsi Tugas</h6>
                    @foreach ( $dataTugas as $data)
                    {!! htmlspecialchars_decode($data->deskripsi_tugas) !!}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                Komentar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                Lampiran Dokumen
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="home-1" role="tabpanel">
                        <h5 class="card-title mb-4">Komentar</h5>
                        <div data-simplebar style="height: 508px;" class="px-3 mx-n3 mb-2">
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    {{-- <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                        class="avatar-xs rounded-circle" /> --}}
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    @foreach ($detailTugas as $item)
                                    <h5 class="fs-13"><a href="pages-profile">{{ $item->penulis }}</a> <small
                                            class="text-muted">{{ $item->tgl_komentar }}</small></h5>
                                    <p class="text-muted">{{ $item->pesan }}</p>
                                    {{-- <div class="d-flex mt-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-10.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="fs-13"><a href="pages-profile">Tonya Noble</a> <small
                                                    class="text-muted">22 Dec 2021 - 02:32PM</small></h5>
                                            <p class="text-muted">Please be sure to check your Spam mailbox to see if
                                                your email filters have identified the email from Dell as spam.</p>
                                            <a href="javascript: void(0);" class="badge text-muted bg-light"><i
                                                    class="mdi mdi-reply"></i> Reply</a>
                                        </div>
                                    </div> --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('simpan.komentar.tugasemp', ['id' => $data->id]) }}" method="POST"
                            enctype="multipart/form-data" autocomplete="off" class="mt-4">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="pesan" class="form-label">Tinggalkan
                                        Komentar</label>
                                    <textarea class="form-control bg-light border-light" id="pesan" name="pesan"
                                        rows="3" placeholder="Tuliskan Komentar"></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i
                                            class="ri-attachment-line fs-16"></i></button>
                                    <button type="submit" class="btn btn-success">Kirim Komentar</button>
                                    <input type="hidden" id="penulis" name="penulis"
                                        value="{{ Auth::user()->user_name }}">
                                    <input type="hidden" id="status_tugas_input" name="status_tugas" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Nama File</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Tanggal Unggah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                        <i class="ri-file-zip-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0)">App
                                                            pages.zip</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Zip File</td>
                                        <td>2.22 MB</td>
                                        <td>21 Dec, 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon"
                                                    id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuLink1"
                                                    data-popper-placement="bottom-end"
                                                    style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-danger-subtle text-danger rounded fs-20">
                                                        <i class="ri-file-pdf-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Velzon
                                                            admin.ppt</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>PPT File</td>
                                        <td>2.24 MB</td>
                                        <td>25 Dec, 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon"
                                                    id="dropdownMenuLink2" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuLink2"
                                                    data-popper-placement="bottom-end"
                                                    style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-info-subtle text-info rounded fs-20">
                                                        <i class="ri-folder-line"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Images.zip</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>ZIP File</td>
                                        <td>1.02 MB</td>
                                        <td>28 Dec, 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon"
                                                    id="dropdownMenuLink3" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuLink3"
                                                    data-popper-placement="bottom-end"
                                                    style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-danger-subtle text-danger rounded fs-20">
                                                        <i class="ri-image-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0"><a
                                                            href="javascript:void(0);">Bg-pattern.png</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>PNG File</td>
                                        <td>879 KB</td>
                                        <td>02 Nov 2021</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon"
                                                    id="dropdownMenuLink4" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuLink4"
                                                    data-popper-placement="bottom-end"
                                                    style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#status_tugas").change(function () {
            var selectedStatus = $(this).val();
            
            $("#status_tugas_input").val(selectedStatus);
        });
    });
</script>
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection