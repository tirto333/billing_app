@extends('su.layouts.master')
@section('title') @lang('translation.team') @endsection
@section('css')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Data Anggota</h5>
                    <div class="flex-shrink-0">
                        <button class="btn btn-success addMembers-modal" data-bs-toggle="modal"
                            data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Tambah
                            Anggota</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>ID Kayawan</th>
                            <th>Email</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $data)
                        <tr>
                            <td class="nama_anggota"><a href="" class="fw-medium link-primary">{{
                                    $data->user_name}}</a></td>
                            <td class="id_karyawan">{{ $data->id_karyawan }}</td>
                            <td class="email">{{ $data->email }}</td>
                            <td class="divisi">{{ $data->divisi }}</td>
                            <td class="posisi">{{ $data->posisi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addmemberModal" tabindex="-1" aria-labelledby="exampleModalgridLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Tambah Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('simpan.anggota') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="id_karyawan" class="form-label">ID Karyawan</label>
                                <input type="text" class="form-control" id="id_karyawan" name="id_karyawan"
                                    placeholder="Masukan Nama Karyawan" required
                                    oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                    oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="user_name" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" id="user_name" name="user_name"
                                    placeholder="Masukan Nama Karyawan" required
                                    oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                    oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="divisi" class="form-label">Divisi</label>
                                <input type="text" class="form-control" id="divisi" name="divisi"
                                    placeholder="Masukan Divisi" required
                                    oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                    oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email"
                                required oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                        </div>
                        <div class="col-xxl-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Masukan Email" required
                                oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Jabatan</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="posisi" id="posisi"
                                        value="Manager" required
                                        oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                        oninput="setCustomValidity('')">
                                    <label class="form-check-label" for="jabatan">Manager</label>
                                    <input type="hidden" id="jabatan" name="jabatan" value="Manager" />
                                    <input type="hidden" id="role_id" name="role_id" value="3" />
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="posisi" id="posisi" value="Staff"
                                        required oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                        oninput="setCustomValidity('')">
                                    <label class="form-check-label" for="jabatan">Staff</label>
                                    <input type="hidden" id="jabatan" name="jabatan" value="Staff" />
                                    <input type="hidden" id="role_id" name="role_id" value="4" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">simpan</button>
                            </div>
                        </div>
                        <input type="hidden" id="dibuat_oleh" name="dibuat_oleh"
                        value="{{ Auth::user()->user_name }}">
                    </div>
                </form>
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

@endsection