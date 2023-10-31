@extends('su.layouts.master')
@section('title')
@lang('translation.supprt-tickets')
@endsection
@section('css')
<link href="{{ URL::asset('build/su/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
{{-- @component('components.breadcrumb')
@slot('li_1')
Tasks
@endslot
@slot('title')
Tasks view
@endslot
@endcomponent --}}

<div class="row">
    <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Total Tiket</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">0</span>
                        </h2>
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
    <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Tiket Tertunda</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">0</span></h2>
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
    <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Tiket Selesai</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">0</span></h2>
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
    <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Tiket Dihapus</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">0</span></h2>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-4">
                                <i class="ri-delete-bin-line"></i>
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
        <div class="card" id="tasksList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Semua Tiket</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Buat Tugas</button>
                            <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form>
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-12">
                            <div class="search-box">
                                <input type="text" class="form-control search bg-light border-light" placeholder="Cari tugas atau apapun ...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-4">
                            <input type="text" class="form-control bg-light border-light" id="demo-datepicker" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Pilih rentang waktu">
                        </div>
                        <div class="col-xxl-3 col-sm-4">
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                    <option value="">Status</option>
                                    <option value="all" selected>Semua</option>
                                    <option value="New">Baru</option>
                                    <option value="Pending">Menunggu</option>
                                    <option value="Inprogress">Proses</option>
                                    <option value="Completed">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-1 col-sm-4">
                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 40px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort" data-sort="id">ID</th>
                                <th class="sort" data-sort="project_name">Judul Tiket</th>
                                <th class="sort" data-sort="tasks_name">Deskripsi Tiket</th>
                                <th class="sort" data-sort="assignedto">Ditujukan Kepada</th>
                                <th class="sort" data-sort="due_date">Tengat Waktu</th>
                                <th class="sort" data-sort="status">Status</th>
                                <th class="sort" data-sort="priority">Prioritas</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            {{-- <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                    </div>
                                </th>
                                <td class="id"><a href="apps-tasks-details" class="fw-medium link-primary">#VLZ501</a></td>
                                <td class="project_name"><a href="apps-projects-overview" class="fw-medium link-primary">Velzon - v1.0.0</a></td>
                                <td>
                                    <div class="d-flex">
                                        <div class="flex-grow-1 tasks_name">Profile Page Satructure</div>
                                        <div class="flex-shrink-0 ms-4">
                                            <ul class="list-inline tasks-list-menu mb-0">
                                                <li class="list-inline-item"><a href="apps-tasks-details"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>
                                                </li>
                                                <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="remove-item-btn" data-bs-toggle="modal" href="#deleteOrder">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <td class="client_name">Robert McMahon</td>
                                <td class="assignedto">
                                    <div class="avatar-group">
                                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Frank">
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle avatar-xxs" />
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Anna">
                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle avatar-xxs" />
                                        </a>
                                    </div>
                                </td>
                                <td class="due_date">25 Jan, 2022</td>
                                <td class="status"><span class="badge bg-secondary-subtle text-secondary text-uppercase">Inprogress</span></td>
                                <td class="priority"><span class="badge bg-danger text-uppercase">High</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                    <div class="noresult" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                            <h5 class="mt-2">Maaf! data tidak ditemukan</h5>
                            <p class="text-muted mb-0">Kami telah mencari lebih dari 200 ribu+ tugas. Kami tidak menemukan Tiket apa pun
                                untukmu mencari.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <div class="pagination-wrap hstack gap-2">
                        <a class="page-item pagination-prev disabled" href="#">
                            Sebelumnya
                        </a>
                        <ul class="pagination listjs-pagination mb-0"></ul>
                        <a class="page-item pagination-next" href="#">
                            Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5 text-center">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                <div class="mt-4 text-center">
                    <h4>Anda akan menghapus Tiket ?</h4>
                    <p class="text-muted fs-14 mb-4">Menghapus Tiket Anda akan menghapus semua
                        informasi Anda dari database.</p>
                    <div class="hstack gap-2 justify-content-center remove">
                        <button class="btn btn-link btn-ghost-success fw-medium text-decoration-none" data-bs-dismiss="modal" id="deleteRecord-close"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                        <button class="btn btn-danger" id="delete-record">Ya, Hapus itu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="exampleModalLabel">Buat Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="tasksId" />
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="projectName-field" class="form-label">Nama Tiket</label>
                            <input type="text" id="projectName-field" class="form-control" placeholder="Nama Proyek" required />
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="tasksTitle-field" class="form-label">Judul</label>
                                <input type="text" id="tasksTitle-field" class="form-control" placeholder="Judul" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Ditujukan Kepada</label>
                            {{-- <div data-simplebar style="height: 95px;">
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-2.jpg" id="james-forbes">
                                            <label class="form-check-label d-flex align-items-center" for="james-forbes">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">James Forbes</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-3.jpg" id="john-robles">
                                            <label class="form-check-label d-flex align-items-center" for="john-robles">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">John Robles</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-4.jpg" id="mary-gant">
                                            <label class="form-check-label d-flex align-items-center" for="mary-gant">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Mary Gant</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-1.jpg" id="curtis-saenz">
                                            <label class="form-check-label d-flex align-items-center" for="curtis-saenz">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Curtis Saenz</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-5.jpg" id="virgie-price">
                                            <label class="form-check-label d-flex align-items-center" for="virgie-price">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Virgie Price</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="anthony-mills">
                                            <label class="form-check-label d-flex align-items-center" for="anthony-mills">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-10.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Anthony Mills</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-6.jpg" id="marian-angel">
                                            <label class="form-check-label d-flex align-items-center" for="marian-angel">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Marian Angel</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="johnnie-walton">
                                            <label class="form-check-label d-flex align-items-center" for="johnnie-walton">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Johnnie Walton</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-8.jpg" id="donna-weston">
                                            <label class="form-check-label d-flex align-items-center" for="donna-weston">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Donna Weston</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-9.jpg" id="diego-norris">
                                            <label class="form-check-label d-flex align-items-center" for="diego-norris">
                                                <span class="flex-shrink-0">
                                                    <img src="{{ URL::asset('build/images/users/avatar-9.jpg') }}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Diego Norris</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="col-lg-6">
                            <label for="duedate-field" class="form-label">Tengat Waktu</label>
                            <input type="text" id="duedate-field" class="form-control" data-provider="flatpickr" placeholder="Tenggat Waktu" required />
                        </div>
                        <div class="col-lg-6">
                            <label for="ticket-status" class="form-label">Status</label>
                            <select class="form-control" id="ticket-status">
                                <option value="">Status</option>
                                <option value="New">Baru</option>
                                <option value="Inprogress">Dalam Proses</option>
                                <option value="Pending">Tertunda</option>
                                <option value="Completed">selesai</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="priority-field" class="form-label">Prioritas</label>
                            <select class="form-control" id="priority-field">
                                <option value="">Prioritas</option>
                                <option value="High">Tinggi</option>
                                <option value="Medium">Sedang</option>
                                <option value="Low">Rendah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Tambah Tiket</button>
                        <button type="button" class="btn btn-success" id="edit-btn">Perbaharui Tiket</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('build/su/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/pages/tasks-list.init.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection
