@extends('su.layouts.master')
@section('title')
@lang('translation.create-project')
@endsection
@section('css')
<link href="{{ URL::asset('build/su/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/su/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/su/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script> --}}
@endsection
@section('content')

<form action="{{ route('simpan.projekmgr') }}" enctype="multipart/form-data" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="jenis_projek">Jenis Projek</label>
                                <select class="form-control" name="jenis_projek" id="jenis_projek">
                                    <option value="">Pilih Jenis Projek</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Installasi">Installasi</option>
                                    <option value="Aktifasi">Aktifasi</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Softblock">Softblock</option>
                                    <option value="Blokir">Blokir</option>
                                    <option value="Dismantle">Dismantle</option>
                                    <option value="Lainnya">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="detail_jprojek">Detail Jenis Projek</label>
                                <select class="form-control" name="detail_jprojek" id="detail_jprojek">
                                    <option value="detailJProjek">Pilih Detail Jenis Projek</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="lingkup_projek"> Lingkup Projek</label>
                                <select class="form-control" name="lingkup_projek" id="lingkup_projek">
                                    <option value="">Pilih Tipe Projek</option>
                                    <option value="customer">Customer</option>
                                    <option value="internal">Internal</option>
                                    <option value="vendor">vendor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" id="no_spk_div">
                            <div class="mb-3">
                                <label class="form-label" for="judul_projek">Input No SPK</label>
                                <input type="text" class="form-control" placeholder="Masukan No SPK" id="no_spk"
                                    name="no_spk">
                            </div>
                        </div>
                        <div class="col-lg-6" id="judul_projek_div" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label" for="judul_projek">Judul Projek</label>
                                <input type="text" class="form-control" placeholder="Masukan judul projek"
                                    id="judul_projek" name="judul_projek">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="pelanggan">Nama Pelanggan</label>
                                <input type="text" class="form-control" placeholder="Input Customer Name" id="pelanggan"
                                    name="pelanggan" required
                                    oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                    oninput="setCustomValidity('')">
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label" for="j_tugas">Judul Tugas</label>
                            <input type="text" class="form-control" placeholder="Masukan judul projek" id="j_tugas"
                                name="j_tugas" required oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                        </div> --}}
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Projek</label>
                            <textarea name="deskripsi_projek" id="ckeditor-classic"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3 mb-lg-0">
                                <label for="prioritas" class="form-label">Prioritas</label>
                                <select class="form-select" id="prioritas" name="prioritas" required
                                    oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                    oninput="setCustomValidity('')">
                                    <option value="">-- Pilih Prioritas --</option>
                                    <option value="Tinggi">Tinggi</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Rendah">Rendah</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 mb-lg-0">
                                <label for="status_projek" class="form-label">Status</label>
                                <select class="form-select" id="status_projek" name="status_projek" required
                                    oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                                    oninput="setCustomValidity('')">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Dalam Proses">Dalam Proses</option>
                                    <option value="Tertunda">Tertunda</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="tenggat_waktu" class="form-label">Tenggat Waktu</label>
                                <input type="text" class="form-control" id="tenggat_waktu" name="tenggat_waktu"
                                    placeholder="Masukan Tenggat Waktu" data-provider="flatpickr" required>
                            </div>
                        </div>
                        {{-- <div class="card">
                            <div class="mb-3">
                                </br>
                                <label class="form-label" for="pelanggan">Tambah lampiran dokumen disini</label>
                                <input type="file" name="file" id="inputFile" multiple
                                    class="form-control @error('file') is-invalid @enderror">
                                @error('file')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                    </div>
                </div>
                </p>
            </div>
            <div class="text-end mb-4">
                <button type="submit" class="btn btn-success w-sm">Buat</button>
            </div>
        </div>
        <div class="col-lg-4">
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Jenis Projek</h5>
                </div>
                <div class="card-body">
                    <div>
                        <label for="t_projek" class="form-label">Status</label>
                        <select class="form-select" id="t_projek" name="t_projek" required
                            oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                            <option value="">-- Pilih Status --</option>
                            <option value="Pribadi">Pribadi</option>
                            <option value="Tim">Tim</option>
                            <option value="Umum">Umum</option>
                        </select>
                    </div>
                </div>
            </div> --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ditujukan Kepada</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kepala_projek" class="form-label">Kepala Tim Projek</label>
                        <select class="form-select" id="kepala_projek" name="kepala_projek[]" data-choices
                            data-choices-removeItem multiple>
                            @foreach ($kepalaProject as $data)
                            <option value="{{ $data->user_name }} - {{ $data->posisi }} - {{ $data->divisi }}">{{
                                $data->user_name }} - {{ $data->posisi }} - {{$data->divisi}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="divisi" name="divisi" value="{{ $data->divisi }}">
                    <div class="mb-3">
                        <label for="nama_anggota" class="form-label">Anggota Tim Projek</label>
                        <select class="form-select" id="nama_anggota" name="nama_anggota[]" data-choices
                            data-choices-removeItem multiple>
                            @foreach ($staffProject as $data)
                            <option value="{{ $data->user_name }} - {{ $data->posisi }} - {{ $data->divisi }}">{{ $data->user_name }} - {{ $data->posisi }} - {{$data->divisi}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="dibuat_oleh" name="dibuat_oleh" value="{{ Auth::user()->user_name }}">
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script>
    var jenisProjekSelect = document.getElementById('jenis_projek');
    var noSpkDiv = document.getElementById('no_spk_div');
    var judulProjekDiv = document.getElementById('judul_projek_div');

    jenisProjekSelect.addEventListener('change', function () {
        if (jenisProjekSelect.value === 'Lainnya') {
            noSpkDiv.style.display = 'none';
            judulProjekDiv.style.display = 'block';
        } else {
            noSpkDiv.style.display = 'block';
            judulProjekDiv.style.display = 'none';
        }
    });
</script>
<script>
    document.getElementById("jenis_projek").addEventListener("change", function () {
        var jenisProjek = this.value;
        var detailJProjek = document.getElementById("detail_jprojek");

        detailJProjek.innerHTML = "";

        if (jenisProjek === "Survey") {
            addOption(detailJProjek, "Survey Wireless", "Survey Wireless");
            addOption(detailJProjek, "Survey FO", "Survey FO");
            addOption(detailJProjek, "Survey AP", "Survey AP");
        } else if (jenisProjek === "Installasi") {
            addOption(detailJProjek, "Installasi Wireless", "Installasi Wireless");
            addOption(detailJProjek, "Installasi V-SAT", "Installasi V-SAT");
            addOption(detailJProjek, "Installasi BTS", "Installasi BTS");
        } else if (jenisProjek === "Aktifasi") {
            addOption(detailJProjek, "Aktifasi Wireless", "Aktifasi Wireless");
            addOption(detailJProjek, "Aktifasi Wifi", "Aktifasi WIFI");
            addOption(detailJProjek, "Aktifasi FO", "Aktifasi FO");
        } else if (jenisProjek === "Maintenance") {
            addOption(detailJProjek, "Maintenance Client", "Maintenance Client");
            addOption(detailJProjek, "Maintenance BTS", "Maintenance BTS");
        } else if (jenisProjek === "Softblock") {
            addOption(detailJProjek, "Softblock Client", "Softblock Client");
        } else if (jenisProjek === "Blokir") {
            addOption(detailJProjek, "Blokir Client", "Blokir Client");
        } else if (jenisProjek === "Dismantle") {
            addOption(detailJProjek, "Dismantle BTS", "Dismantle BTS");
            addOption(detailJProjek, "Dismantle Client", "Dismantle Client");
        } else if (jenisProjek === "Other") {
            addOption(detailJProjek, "Lainnya", "Lainnya");
        }
    });

    function addOption(select, value, text) {
        var option = document.createElement("option");
        option.value = value;
        option.text = text;
        select.appendChild(option);
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectElement = document.getElementById("kepala_projek");
        const selectedData = [];
    
        selectElement.addEventListener("change", function() {
            const selectedOptions = Array.from(selectElement.selectedOptions);
            selectedData.length = 0;
    
            selectedOptions.forEach(option => {
                const userData = option.value.split(" - ");
                const user = userData[0];
                const posisi = userData[1];
                const divisi = userData[2];
                selectedData.push({ user, posisi, divisi });
            });
        });
    });
</script>
<script src="{{ URL::asset('build/su/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/pages/project-create.init.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/su/libs/quill/quill.min.js') }}"></script>
<script src="{{ URL::asset('build/su/js/pages/form-editor.init.js') }}"></script>
<script src="{{ URL::asset('build/su/js/app.js') }}"></script>
@endsection