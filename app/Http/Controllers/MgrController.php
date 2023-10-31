<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\AnggotaProjek;
use App\Models\KepalaProjek;
use App\Models\KomentarProjeks;
use App\Models\projek;
use App\Models\ProjekDetail;
use App\Models\ProjekManager;
use App\Models\SubAnggotaProjek;
use App\Models\SubKepalaProjek;
use App\Models\Tugas;
use App\Models\TugasDari;
use App\Models\TugasDetail;
use App\Models\TugasUntuk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MgrController extends Controller
{

    public function agendamgr()
    {
        return view('mgr.agenda.acara');
    }

    public function projekmgr()
    {
        $mgr = Auth::user();
        $totalProjek = KepalaProjek::where('nm_anggota', $mgr->user_name)->count('nm_anggota');
        // $statusBerlangsung = Projek::where('kepala_projek', $mgr->user_name)->count();
        // $subProjBerlangsung = ProjekManager::where('dibuat_oleh', $mgr->user_name)->count();
        // $kepalaProjeks = KepalaProjek::where('nm_anggota', $mgr->user_name)->get();
        // $dataProject = Projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get();

        $projeks = KepalaProjek::join('projeks', 'projeks.id', '=', 'kepala_projeks.id_projek')
            ->where('kepala_projeks.nm_anggota', $mgr->user_name)
            ->get();

        // $subProjeks = ProjekManager::join('kepala_projeks', 'kepala_projeks.id_subprojek', '=', 'projek_managers.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get();

        // $projeks = Projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get()
        //     ->merge(ProjekManager::join('kepala_projeks', 'kepala_projeks.id_subprojek', '=', 'projek_managers.id')
        //         ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //         ->get());

        $dataProjectBaru = projek::select('projeks.*')
            ->where('status_projek', 'Baru')
            ->count();

        // $dataProjectBaru = Projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->where('status_projek', 'Baru')
        //     ->count();

        // $projeks = [];

        // foreach ($kepalaProjeks as $kepalaProjek) {
        //     $projek = $kepalaProjek->projek;

        //     if ($projek) {
        //         $projeks[] = $projek;
        //     }
        // }
        return view('mgr.proyek.proyek', compact('totalProjek', 'dataProjectBaru', 'projeks'));
    }

    public function buatprojekmgr()
    {
        $mgr = Auth::user();
        $kepalaProjeks = KepalaProjek::where('nm_anggota', $mgr->user_name)->first();
        $anggota = DB::table('anggotas')
            ->select('anggotas.*')
            ->get();

        $kepalaProject = anggota::select('anggotas.*')
            ->where('posisi', 'Manager')
            ->get();

        $staffProject = DB::table('anggotas')
            ->select('anggotas.*')
            ->where('posisi', 'Staff')
            ->get();

        if ($kepalaProjeks) {
            $divisi = $kepalaProjeks->divisi;
            $staffProject = Anggota::where('divisi', $divisi)->where('posisi', 'Staff')->get();
        }

        return view('mgr.proyek.tambahproyek', compact('anggota', 'kepalaProject', 'staffProject'));
    }

    public function simpanprojekmgr(Request $request)
    {
        $data = new ProjekManager();
        $data->no_spk = $request->no_spk;
        $data->judul_projek = $request->judul_projek;
        $data->jenis_projek = $request->jenis_projek;
        $data->detail_jprojek = $request->detail_jprojek;
        $data->lingkup_projek = $request->lingkup_projek;
        $data->pelanggan = $request->pelanggan;
        $data->deskripsi_projek = $request->deskripsi_projek;
        $data->prioritas = $request->prioritas;
        $data->status_projek = $request->status_projek;
        $data->tenggat_waktu = $request->tenggat_waktu;
        $data->dibuat_oleh = $request->dibuat_oleh;
        // $data->divisi = $request->divisi;
        $data->nama_anggota = json_encode($request->nama_anggota);
        $data->kepala_projek = json_encode($request->kepala_projek);
        $data->save();

        if (is_array($request->nama_anggota)) {
            foreach ($request->nama_anggota as $nama) {
                $data_kepala = explode(' - ', $nama);
                $anggota = new SubAnggotaProjek();
                $anggota->id_subprojek = $data->id;
                $anggota->nm_anggota = $data_kepala[0]; // Nama anggota
                // $anggota->divisi = $data_kepala[2];
                $anggota->dibuat_oleh = $data->dibuat_oleh;
                $anggota->save();
            }
        }

        if (is_array($request->kepala_projek)) {
            foreach ($request->kepala_projek as $kepala) {
                $data_kepala = explode(' - ', $kepala);
                $kpl = new SubKepalaProjek();
                $kpl->id_subprojek = $data->id;
                $kpl->nm_anggota = $data_kepala[0]; // Nama anggota
                // $kpl->divisi = $data_kepala[2];
                $kpl->dibuat_oleh = $data->dibuat_oleh;
                $kpl->save();
            }
        }

        return redirect()->route('projek.mgr');
    }

    public function detailprojekmgr($id): View
    {
        $mgr = Auth::user();
        $project = projek::find($id);
        $total = KepalaProjek::distinct('id_projek')
            ->count('id_projek');

        // $tugas = TugasUntuk::distinct('id_tugas')
        //     // ->where('tugas_untuks.tugas_dari', $mgr->user_name)
        //     ->count('id_tugas');

        $kepalaProjek = KepalaProjek::select('kepala_projeks.*')
            ->where('id_projek', $id)
            // ->where('tugas_anggotas.tugas_dari', $mgr->user_name)
            ->get();

        $anggotaProjek = TugasUntuk::select('tugas_untuks.*')
            ->where('tugas_dari', $mgr->user_name)
            // ->where('tugas_anggotas.tugas_dari', $mgr->user_name)
            ->get();

        $dataProjek = projek::select('projeks.*')
            ->where('id', $id)
            ->get();

        $tugasProjek = projek::join('tugas_untuks', 'tugas_untuks.id_projek', '=', 'projeks.id')
            ->where('tugas_untuks.id_projek', $id)
            ->get();

        $detailProjek = ProjekDetail::select('projek_details.*')
            ->where('id_projek', $id)
            ->get();

        return view('mgr.proyek.detailproyek', compact('dataProjek', 'kepalaProjek', 'total', 'detailProjek', 'tugasProjek', 'anggotaProjek'));
    }


    public function simpankomentarmgr(Request $request, $id)
    {
        $project = Projek::find($id);

        $data['id_projek'] = $project->id;
        $data['pesan'] = $request->pesan;
        $data['penulis'] = $request->penulis;

        $projekDetail = new ProjekDetail($data);
        $projekDetail->save();

        // dd($request->all());
        return redirect()->route('projekmgr');
    }

    public function detailsubprojekmgr($id): View
    {
        $mgr = Auth::user();
        $project = projek::find($id);
        $total = KepalaProjek::distinct('id_projek')
            ->count('id_projek');

        // $tugas = TugasUntuk::distinct('id_tugas')
        //     // ->where('tugas_untuks.tugas_dari', $mgr->user_name)
        //     ->count('id_tugas');

        $kepalaProjek = SubKepalaProjek::select('sub_kepala_projeks.*')
            // ->where('id_projek', $id)
            // ->where('tugas_anggotas.tugas_dari', $mgr->user_name)
            ->get();

        $anggotaProjek = SubAnggotaProjek::select('sub_anggota_projeks.*')
            // ->where('id_projek', $id)
            // ->where('tugas_anggotas.tugas_dari', $mgr->user_name)
            ->get();

        $dataProjek = ProjekManager::select('projek_managers.*')
            ->where('id', $id)
            ->get();

        return view('mgr.proyek.subdetailproyek', compact('dataProjek', 'kepalaProjek', 'total', 'anggotaProjek'));
    }

    public function detailtugasmgr($id)
    {
        $mgr = Auth::user();
        $task = Tugas::find($id);

        $dataTugas = Tugas::where('id', $id)->get();

        $tugasUntuk = TugasUntuk::findOrFail($id)
            ->where('tugas_untuks.tugas_dari', $mgr->user_name)
            ->get();

        $megetahui = TugasUntuk::findOrFail($id)
            ->where('tugas_untuks.tugas_dari', $mgr->user_name)
            ->get();

        $anggota = Anggota::select('anggotas.*')->get();

        $detailTugas = TugasDetail::select('tugas_details.*')
            ->get();

        return view('mgr.tugas.detailtugas', compact('task', 'anggota', 'dataTugas', 'tugasUntuk', 'megetahui', 'detailTugas'));
    }

    public function updatetugasmgr(Request $request, $id)
    {
        $data['komentar'] = $request->komentar;
        $data['penulis'] = $request->penulis;
        projek::updateOrInsert(['id' => $id], $data);
        return view('mgr.tugas.detailtugas', compact('task', 'anggota', 'dataTugas', 'tugasUntuk', 'megetahui'));
    }

    public function tugasmgr()
    {
        $mgr = Auth::user();
        $kepalaProjeks = KepalaProjek::where('nm_anggota', $mgr->user_name)->first();

        $total = Tugas::count();
        $TaskBerlangsung = Tugas::where('status_tugas', 'Baru')->count();

        // $jProjek = Projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get();

        // $ajProjek = ProjekManager::join('kepala_projeks', 'kepala_projeks.id_subprojek', '=', 'projek_managers.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get();

        // $mergedData = $jProjek->concat($ajProjek);

        $sjProjek = Projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
            ->where('kepala_projeks.nm_anggota', $mgr->user_name)
            ->get();
        //     ->merge(ProjekManager::join('kepala_projeks', 'kepala_projeks.id_subprojek', '=', 'projek_managers.id')
        //         ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //         ->get());

        // $jsPorjek = ProjekManager::join('kepala_projeks', 'kepala_projeks.id_subprojek', '=', 'projek_managers.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get();

        // $jPorjek = Projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get()
        //     ->concat(ProjekManager::join('kepala_projeks', 'kepala_projeks.id_subprojek', '=', 'projek_managers.id')
        //         ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //         ->get());

        $tugas = Tugas::select('tugas_anggotas.*')
            ->where('tugas_anggotas.tugas_dari', $mgr->user_name)
            ->get();

        // $tAnggota = Tugas::select('tugas_anggotas.*')->get();

        $aProjek = DB::table('anggotas')
            ->select('anggotas.*')
            ->where('posisi', 'Staff')
            ->get();

        if ($kepalaProjeks) {
            $divisi = $kepalaProjeks->divisi;
            $aProjek = Anggota::where('divisi', $divisi)->where('posisi', 'Staff')->get();
        }

        // $kepala = DB::table('anggotas')
        //     ->select('anggotas.*')
        //     ->where('posisi', 'Manager')
        //     ->get();

        return view('mgr.tugas.tugas', compact('sjProjek', 'aProjek', 'total', 'TaskBerlangsung', 'tugas'));
    }

    public function simpantugasmgr(Request $request)
    {
        $data = new Tugas();
        $data->projek_tugas = $request->projek_tugas;
        $data->ditugaskan = json_encode($request->ditugaskan);
        $data->deskripsi_tugas = $request->deskripsi_tugas;
        $data->tenggat_waktu = $request->tenggat_waktu;
        $data->status_tugas = $request->status_tugas;
        $data->prioritas_tugas = $request->prioritas_tugas;
        $data->tugas_dari = $request->tugas_dari;
        $data->save();

        if (is_array($request->ditugaskan)) {
            foreach ($request->ditugaskan as $anggota) {
                $data_anggota = explode(' - ', $anggota);
                $anggota = new TugasUntuk();
                $anggota->id_projek = $data->id;
                $anggota->id_tugas = $data->id;
                $anggota->nm_anggota = $data_anggota[0];
                $anggota->divisi = $data_anggota[2];
                $anggota->tugas_dari = $data->tugas_dari;
                $anggota->penerima_tugas = $data_anggota[0];
                $anggota->save();
            }
        }

        if (is_array($request->ditugaskan)) {
            foreach ($request->ditugaskan as $ta) {
                $data_anggota = explode(' - ', $ta);
                $ta = new TugasDetail();
                $ta->id_tugas = $data->id;
                $ta->nm_anggota = $data_anggota[0];
                $ta->posisi = $data_anggota[1];
                $ta->divisi = $data_anggota[2];
                $ta->prioritas = $request->prioritas;
                $ta->status_tugas = $request->status_tugas;
                $ta->save();
            }
        }

        // if ($data) {
        //     $projek = Projek::where('judul_projek', $data->projek_tugas)->first();

        //     if ($projek) {
        //         $projek->nama_anggota = json_encode($request->ditugaskan);
        //         $projek->save();
        //     }
        // }

        // dd($request->all());
        // dd($data_anggota->all());
        return redirect()->route('tugas.mgr');
    }

    public function simpankomentartugasmgr(Request $request, $id)
    {
        $tugas = Tugas::find($id);

        $tugasDetail = new TugasDetail();
        $tugasDetail->id_tugas = $tugas->id;
        $tugasDetail->status_tugas = $request->status_tugas;
        $tugasDetail->pesan = $request->pesan;
        $tugasDetail->file = $request->file;
        $tugasDetail->penulis = $request->penulis;
        $tugasDetail->save();

        $tugasAnggota = Tugas::where('id', $tugas->id)->first();

        if ($tugasAnggota) {
            $tugasAnggota->status_tugas = $request->status_tugas;
            $tugasAnggota->save();
        }

        $tugasAnggota = projek::where('id', $tugas->id)->first();

        if ($tugasAnggota) {
            $tugasAnggota->status_projek = $request->status_tugas;
            $tugasAnggota->save();
        }

        $tugasAnggota = ProjekDetail::where('id_projek', $tugas->id)->first();

        if ($tugasAnggota) {
            $tugasAnggota->status_projek = $request->status_tugas;
            $tugasAnggota->save();
        }

        // dd($request->all());
        return redirect()->route('tugas.mgr');
    }
}
