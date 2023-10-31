@extends('mgr.layouts.master')
@section('title')
    @lang('translation.event')
@endsection
@section('content')
    {{-- @component('components.breadcrumb')
        @slot('li_1')
            Apps
        @endslot
        @slot('title')
            Calendar
        @endslot
    @endcomponent --}}
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <button class="btn btn-primary w-100" id="btn-new-event"><i class="mdi mdi-plus"></i> Buat Agenda Baru</button>
                            <div id="external-events">
                                <br>
                                <p class="text-muted">Seret dan lepas agenda Anda atau klik di kalender</p>
                                <div class="external-event fc-event bg-success-subtle text-success"
                                    data-class="bg-success-subtle">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Agenda Baru
                                </div>
                                <div class="external-event fc-event bg-info-subtle text-info" data-class="bg-info-subtle">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Rapat
                                </div>
                                <div class="external-event fc-event bg-warning-subtle text-warning"
                                    data-class="bg-warning-subtle">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Membuat Laporan
                                </div>
                                <div class="external-event fc-event bg-danger-subtle text-danger"
                                    data-class="bg-danger-subtle">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Buat Laporan Baru
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-1">Agenda Mendatang</h5>
                        <p class="text-muted">jangan lewatkan agenda yang dijadwalkan</p>
                        <div class="pe-2 me-n1 mb-3" data-simplebar style="height: 400px">
                            <div id="upcoming-event-list"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div style='clear:both'></div>
            {{-- @include('su.utills.event') --}}
            <div class="modal fade" id="event-modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header p-3 bg-info-subtle">
                            <h5 class="modal-title" id="modal-title">Acara</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                <div class="text-end">
                                    <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event"
                                        onclick="editEvent(this)" role="button">Ubah</a>
                                </div>
                                <div class="event-details">
                                    <div class="d-flex mb-2">
                                        <div class="flex-grow-1 d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-calendar-event-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0" id="event-start-date-tag"></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="ri-time-line text-muted fs-16"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="d-block fw-semibold mb-0"><span id="event-timepicker1-tag"></span> -
                                                <span id="event-timepicker2-tag"></span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="ri-map-pin-line text-muted fs-16"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="d-block fw-semibold mb-0"> <span id="event-location-tag"></span></h6>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="ri-discuss-line text-muted fs-16"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="d-block text-muted mb-0" id="event-description-tag"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row event-form">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Tipe Agenda </label>
                                            <select class="form-select d-none" name="category" id="event-category" required>
                                                <option value="bg-danger-subtle">Penting</option>
                                                <option value="bg-success-subtle">Segera</option>
                                                <option value="bg-primary-subtle">ASAP</option>
                                                {{-- <option value="bg-info-subtle">Info</option>
                                                <option value="bg-dark-subtle">Dark</option>
                                                <option value="bg-warning-subtle">Warning</option> --}}
                                            </select>
                                            <div class="invalid-feedback">Silahkan pilih kategori agendaS</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Agenda</label>
                                            <input class="form-control d-none" placeholder="Isi Nama Acara" type="text" name="title"
                                                id="event-title" required value="" />
                                            <div class="invalid-feedback">Silahkan isi nama agenda</div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label>Waktu Agenda</label>
                                            <div class="input-group d-none">
                                                <input type="text" id="event-start-date"
                                                    class="form-control flatpickr flatpickr-input" placeholder="Pilih Waktu"
                                                    readonly required>
                                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="event-time">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Waktu Mulai</label>
                                                    <div class="input-group d-none">
                                                        <input id="timepicker1" type="text"
                                                            class="form-control flatpickr flatpickr-input"
                                                            placeholder="Pilih Waktu Mulai" readonly>
                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Waktu Selesai</label>
                                                    <div class="input-group d-none">
                                                        <input id="timepicker2" type="text"
                                                            class="form-control flatpickr flatpickr-input"
                                                            placeholder="Pilih Waktu Selesai" readonly>
                                                        <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="event-location">Lokasi</label>
                                            <div>
                                                <input type="text" class="form-control d-none" name="event-location"
                                                    id="event-location" placeholder="Lokasi Acara">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <input type="hidden" id="eventid" name="eventid" value="" />
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea class="form-control d-none" id="event-description" placeholder="Isi Deskripsi"
                                                rows="3" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-soft-danger" id="btn-delete-event"><i
                                            class="ri-close-line align-bottom"></i> Hapus</button>
                                    <button type="submit" class="btn btn-success" id="btn-save-event">Tambah Agenda</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/su/libs/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ URL::asset('build/su/js/pages/calendar.init.js') }}"></script>
    <script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection
