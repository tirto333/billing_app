@extends('su.layouts.master')
@section('title')
@lang('translation.list-view')
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/su/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-4 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Jumlah Tugas</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                data-target="{{ $total }}">{{ $total }}</span>
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
                        <p class="fw-medium text-muted mb-0">Tugas Tetunda</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                data-target="{{ $TaskBerlangsung }}">{{ $TaskBerlangsung }}</span>
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
                        <p class="fw-medium text-muted mb-0">Tugas Selesai</p>
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
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Semua Tugas</h5>
                <div class="flex-shrink-0">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i
                                class="ri-add-line align-bottom me-1"></i>Buat Tugas</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="alternative-pagination" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Judul Projek</th>
                            <th scope="col" style="width: 15%;">Nama Tugas</th>
                            <th>Ditugaskan Untuk</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th>Prioritas Tugas</th>
                            <th>Dibuat Tanggal</th>
                            <th>Tenggat Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTugas as $key => $data)
                        <tr>
                            <td class="nm_pelanggan">
                                <a href="{{ route('detail.tugas', ['id' => $data->id]) }}"
                                    class="fw-medium link-primary">{{ $data->projek_tugas }}</a>
                            </td>
                            <td class="nama_projek"></a>{!! htmlspecialchars_decode($data->deskripsi_tugas) !!}</td>
                            {{-- <td class="pelanggan">
                                @foreach($mergedData as $item)
                                {{ $item->pelanggan }}
                                @endforeach
                            </td> --}}
                            <td class="ditugaskan">
                                @php
                                $ditugaskan = json_decode($data->ditugaskan);
                                @endphp
                                @if ($ditugaskan)
                                @foreach($ditugaskan as $anggota)
                                {{ $anggota }}<br>
                                @endforeach
                                @endif
                            </td>
                            <td class="kepala_projek">{{ $data->tugas_dari}}</td>
                            <td class="status_projek">
                                @if ($data->status_tugas == 'Baru')
                                <span class="badge bg-info-subtle text-info text-uppercase">Baru</span>
                                @elseif ($data->status_tugas == 'Dalam Proses')
                                <span class="badge bg-secondary-subtle text-secondary text-uppercase">Dalam
                                    Proses</span>
                                @elseif ($data->status_tugas == 'Tertunda')
                                <span class="badge bg-danger-subtle text-danger text-uppercase">Tertunda</span>
                                @elseif ($data->status_tugas== 'Selesai')
                                <span class="badge bg-success-subtle text-success text-uppercase">Selesai</span>
                                @endif
                            </td>
                            <td class="prioritas">
                                @if ($data->prioritas_tugas == 'Rendah')
                                <span class="badge bg-info text-uppercase">Sedang</span>
                                @elseif ($data->prioritas_tugas == 'Sedang')
                                <span class="badge bg-warning text-uppercase">Sedang</span>
                                @elseif ($data->prioritas_tugas == 'Tinggi')
                                <span class="badge bg-danger text-uppercase">Tinggi</span>
                                @endif
                            </td>
                            <td class="tenggat_waktu">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            <td class="tenggat_waktu">{{ date('d-m-Y', strtotime($data->tenggat_waktu)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="exampleModalLabel">Buat Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="{{ route ('simpan.tugas') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="tasksId" />
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="projek_tugas" class="form-label">Nama Projek</label>
                            <select class="form-select" id="projek_tugas" name="projek_tugas" data-choices
                                data-choices-removeItem multiple required
                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                                @foreach ($dataPel as $data)
                                <option value="{{ $data->no_spk }}"> {{ $data->no_spk }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="ditugaskan" class="form-label">Ditugaskan Kepada</label>
                            <select class="form-select" id="ditugaskan" name="ditugaskan[]" data-choices
                                data-choices-removeItem multiple required
                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                                @foreach ($staffs as $data)
                                <option value="{{ $data->user_name }}">{{ $data->user_name }} - {{ $data->posisi}}
                                    {{$data->divisi}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Deskripsi Tugas</label>
                                <textarea name="deskripsi_tugas" id="ckeditor-classic"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="tenggat_waktu" class="form-label">Tenggat Waktu</label>
                            <input type="text" id="tenggat_waktu" name="tenggat_waktu" class="form-control"
                                data-provider="flatpickr" placeholder="Tenggat Waktu" required
                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                oninput="setCustomValidity('')" />
                        </div>
                        <div class="col-lg-4">
                            <label for="status_tugas" class="form-label">Status</label>
                            <select class="form-control" id="status_tugas" name="status_tugas">
                                <option>-- Status --</option>
                                <option value="Baru">Baru</option>
                                <option value="Dalam Proses">Dalam Proses</option>
                                <option value="Tertunda">Tertunda</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="prioritas_tugas" class="form-label">Prioritas Tugas</label>
                            <select class="form-control" id="prioritas_tugas" name="prioritas_tugas">
                                <option>-- prioritas --</option>
                                <option value="Tinggi">Tinggi</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Rendah">Rendah</option>
                            </select>
                        </div>
                        <input type="hidden" id="tugas_dari" name="tugas_dari" value="{{ Auth::user()->user_name }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal"
                            data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Tambah Tugas</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('build/su/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/pages/project-create.init.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/prismjs/prism.js') }}"></script>
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
<script src="{{ URL::asset('build/su/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/pages/tasks-list.init.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection