<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\AnggotaProjek;
use App\Models\KepalaProjek;
use App\Models\KomentarProjeks;
use App\Models\projek;
use App\Models\ProjekDetail;
use App\Models\Tugas;
use App\Models\TugasDetail;
use App\Models\TugasUntuk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpController extends Controller
{
    public function projekemp()
    {
        $wmp = Auth::user();
        $total = AnggotaProjek::distinct('id_projek')->count('id_projek');
        $tProjek = TugasUntuk::where('tugas_untuks.nm_anggota', $wmp->user_name)->count();

        $tugasBerlangsung = projek::join('anggota_projeks', 'anggota_projeks.id_projek', '=', 'projeks.id')
            ->where('anggota_projeks.nm_anggota', $wmp->user_name)
            ->where('status_projek', 'Baru')
            ->count();

        $tugas = TugasUntuk::where('tugas_untuks.nm_anggota', $wmp->user_name)->get();
        $dataTugas = TugasUntuk::join('projeks', 'projeks.id', '=', 'tugas_untuks.id_projek')
            ->where('tugas_untuks.nm_anggota', $wmp->user_name)
            ->get();

        return view('emp.proyek.proyek', compact('tugas', 'total', 'tugasBerlangsung', 'tProjek', 'dataTugas'));
    }

    public function detailprojekemp($id): View
    {
        $wmp = Auth::user();
        $totalProjek = Projek::select('judul_projek', 'no_spk')
            ->groupBy('judul_projek', 'no_spk')
            ->count();

        $totalTugas = projek::join('anggota_projeks', 'anggota_projeks.id_projek', '=', 'projeks.id')
            ->where('anggota_projeks.nm_anggota', $wmp->user_name)
            ->count();

        $dataProjek = TugasUntuk::join('projeks', 'projeks.id', '=', 'tugas_untuks.id_projek')
            ->where('tugas_untuks.nm_anggota', $wmp->user_name)
            ->get();

        $dataAnggotaProjek = projek::join('tugas_untuks', 'tugas_untuks.id_projek', '=', 'projeks.id')
            // ->where('anggota_projeks.nm_anggota', $wmp->user_name)
            ->get();

        $kepalaProjek = projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
            // ->where('divisi', 'Presales')
            ->get();

        $dataAnggota = Anggota::select('anggotas.*')
            ->get();

        $detailsProjek = projek::select('projeks.*')
            ->where('id', $id)
            ->get();

        $tugasProjek = projek::join('tugas_untuks', 'tugas_untuks.id_projek', '=', 'projeks.id')
            ->where('tugas_untuks.id_projek', $id)
            ->get();

        $detailProjek = ProjekDetail::select('projek_details.*')
            ->where('id_projek', $id)
            ->get();

        return view('emp.proyek.detailproyek', compact('dataProjek', 'totalProjek', 'totalTugas', 'dataAnggota', 'kepalaProjek', 'dataAnggotaProjek', 'detailsProjek', 'tugasProjek', 'detailProjek'));
    }

    public function simpankomentaremp(Request $request, $id)
    {
        $project = Projek::find($id);

        $data['id_projek'] = $project->id;
        $data['pesan'] = $request->pesan;
        $data['penulis'] = $request->penulis;

        $projekDetail = new ProjekDetail($data);
        $projekDetail->save();

        // dd($request->all());
        return redirect()->route('projek.emp');
    }

    public function tugasemp()
    {
        $mgr = Auth::user();
        $total = Tugas::count();
        $TaskBerlangsung = Tugas::where('status_tugas', 'Baru')->count();
        $nmPel = projek::join('tugas_untuks', 'tugas_untuks.id_projek', '=', 'projeks.id')
            ->where('tugas_untuks.nm_anggota', $mgr->user_name)
            ->get();

        $dataTugas = TugasUntuk::join('tugas_anggotas', 'tugas_untuks.id_tugas', '=', 'tugas_anggotas.id')
            ->where('tugas_untuks.penerima_tugas', $mgr->user_name)
            ->get();
        // $dataTugas = TugasUntuk::where('penerima_tugas', $mgr->user_name)
        //     ->get();

        $staffs = DB::table('anggotas')
            ->select('anggotas.*')
            ->where('posisi', 'Staff')
            ->get();

        $kepala = DB::table('anggotas')
            ->select('anggotas.*')
            ->where('posisi', 'Manager')
            ->get();

        return view('emp.tugas.tugas', compact('total', 'TaskBerlangsung', 'dataTugas', 'staffs', 'kepala', 'nmPel'));
    }

    public function detailtugasemp($id)
    {
        $mgr = Auth::user();
        $task = Tugas::find($id);

        $dataTugas = Tugas::where('id', $id)->get();

        $tugasUntuk = TugasUntuk::findOrFail($id)->get();

        $megetahui = Tugas::findOrFail($id)->get();

        $anggota = Anggota::select('anggotas.*')->get();

        $detailTugas = TugasDetail::select('tugas_details.*')
        ->get();

        return view('emp.tugas.detailtugas', compact('task', 'anggota', 'dataTugas', 'tugasUntuk', 'megetahui', 'detailTugas'));
    }

    public function simpankomentartugasemp(Request $request, $id)
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
        return redirect()->route('tugas.emp');
    }
}
