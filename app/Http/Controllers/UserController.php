<?php

namespace App\Http\Controllers;

use App\Models\KepalaProjek;
use App\Models\projek;
use App\Models\ProjekManager;
use App\Models\Tugas;
use App\Models\TugasDari;
use App\Models\TugasUntuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function su()
    {
        $lead = Auth::user();
        $projeks = projek::select('projeks.*')
            // ->where('status_projek', 'Baru')
            ->get();

        $tugasAnggotas = Tugas::select('tugas_anggotas.*')
            // ->where('status_projek', 'Baru')
            ->get();

        $tProjek = projek::where('dibuat_oleh', $lead->user_name)->count();

        return view('su.dashboard', compact('projeks', 'tProjek', 'tugasAnggotas'));
    }

    public function manager()
    {
        $mgr = Auth::user();
        $projeks = KepalaProjek::join('projeks', 'projeks.id', '=', 'kepala_projeks.id_projek')
            ->where('kepala_projeks.nm_anggota', $mgr->user_name)
            ->get();

        $tProjek = KepalaProjek::where('nm_anggota', $mgr->user_name)->count();

        // $projeks = [];

        // foreach ($kepalaProjeks as $kepalaProjek) {
        //     $projek = $kepalaProjek->projek;

        //     if ($projek) {
        //         $projeks[] = $projek;
        //     }
        // }

        // $lampiranTugas = TugasDari::where('mengetahui', $mgr->user_name)->get();

        // $tugasArray = [];

        // foreach ($lampiranTugas as $mengetahuitugas) {
        //     $tugas = $mengetahuitugas->tugas;

        //     if ($tugas) {
        //         $tugasArray[] = $tugas;
        //     }
        // }

        // $total = Tugas::count();
        // $TaskBerlangsung = Tugas::where('status_tugas', 'Dalam Proses')->count();

        // $dataProject = projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
        //     ->where('kepala_projeks.nm_anggota', $mgr->user_name)
        //     ->get();

        // $staffs = DB::table('anggotas')
        //     ->select('anggotas.*')
        //     ->where('posisi', 'Staff')
        //     ->get();

        // $kepala = DB::table('anggotas')
        //     ->select('anggotas.*')
        //     ->where('posisi', 'Manager')
        //     ->get();

        return view('mgr.dashboard', compact('tProjek', 'projeks'));
    }

    public function employee()
    {
        $emp = Auth::user();
        // $kepalaProjeks = TugasUntuk::where('penerima_tugas', $emp->user_name)->get();
        $tProjek = TugasUntuk::where('penerima_tugas', $emp->user_name)->count();

        // $projeks = [];

        // foreach ($kepalaProjeks as $kepalaProjek) {
        //     $projek = $kepalaProjek->projek;

        //     if ($projek) {
        //         $projeks[] = $projek;
        //     }
        // }

        // $lampiranTugas = TugasDari::where('mengetahui', $emp->user_name)->get();

        // $tugasArray = [];

        // foreach ($lampiranTugas as $mengetahuitugas) {
        //     $tugas = $mengetahuitugas->tugas;

        //     if ($tugas) {
        //         $tugasArray[] = $tugas;
        //     }
        // }

        // $total = Tugas::count();
        // $TaskBerlangsung = Tugas::where('status_tugas', 'Dalam Proses')->count();

        $dataProject = Tugas::join('tugas_untuks', 'tugas_untuks.id_projek', '=', 'tugas_anggotas.id')
            ->where('tugas_untuks.nm_anggota', $emp->user_name)
            ->get();

        // $staffs = DB::table('anggotas')
        //     ->select('anggotas.*')
        //     ->where('posisi', 'Staff')
        //     ->get();

        // $kepala = DB::table('anggotas')
        //     ->select('anggotas.*')
        //     ->where('posisi', 'Manager')
        //     ->get();

        // $empByEmail = User::where('email', $emp->email)->get;
        return view('emp.dashboard', compact('tProjek', 'dataProject'));
    }
}
