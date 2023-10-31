<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\AnggotaProjek;
use App\Models\KepalaProjek;
use App\Models\projek;
use App\Models\ProjekDetail;
use App\Models\Tugas;
use App\Models\TugasDari;
use App\Models\TugasDetail;
use App\Models\TugasUntuk;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuDashboardController extends Controller
{
    public function agenda()
    {
        return view('su.agenda.acara');
    }

    // ==================================  MENU PROJEK  ================================== //

    public function proyek()
    {
        $totalProjek = Projek::distinct('judul_projek')->count('judul_projek');
        $totalSpk = Projek::distinct('no_spk')->count('no_spk');
        $statusBerlangsung = Projek::where('status_projek', 'Baru')->count();

        $dataProject = projek::select('projeks.*')
            // ->where('status_projek', 'Baru')
            ->get();

        // $subProjeks = ProjekManager::select('projek_managers.*')
        //     // ->where('projek_managers.dibuat_oleh')
        //     ->get();

        // $dataaProjek = ProjekManager::select('projek_managers.*')
        //     ->get();

        // $mergedData = $dataProject->concat($dataaProjek);
        // $kepalaProject = anggota::select('anggotas.*')
        //     ->where('posisi', 'Manager')
        //     ->get();

        // $tAnggota = Tugas::select('tugas_anggotas.*')
        //     ->get();

        return view('su.proyek.proyek', compact('totalProjek', 'totalSpk', 'statusBerlangsung', 'dataProject'));
    }

    public function buatproyek()
    {
        $anggota = Anggota::select('anggotas.*')
            ->get();

        $kepalaProject = anggota::select('anggotas.*')
            ->where('posisi', 'Manager')
            ->get();

        // $staffProject = anggota::select('anggotas.*')
        //     ->where('posisi', 'Staff')
        //     ->get();

        return view('su.proyek.tambahproyek', compact('anggota', 'kepalaProject'));
    }

    public function simpanproyek(Request $request)
    {
        $data = new projek();
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
        // $data->nama_anggota = json_encode($request->nama_anggota);
        $data->kepala_projek = json_encode($request->kepala_projek);
        $data->save();

        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,jpg,jpeg,png|max:2048',
        ]);

        $fileName = time() . '.' . $request->file->extension();
        $request->file->storeAs('public/file/file_projek', $fileName);

        if (is_array($request->kepala_projek)) {
            foreach ($request->kepala_projek as $kepala) {
                $data_kepala = explode(' - ', $kepala);
                $kpl = new KepalaProjek();
                $kpl->id_projek = $data->id;
                $kpl->nm_anggota = $data_kepala[0];
                $kpl->posisi = $data_kepala[1];
                $kpl->divisi = $data_kepala[2];
                $kpl->dibuat_oleh = $data->dibuat_oleh;
                $kpl->save();
            }
        }

        if (is_array($request->kepala_projek)) {
            foreach ($request->kepala_projek as $kepala) {
                $data_kepala = explode(' - ', $kepala);
                $pd = new ProjekDetail();
                $pd->id_tugas = $data->id;
                $pd->nm_anggota = $data_kepala[0];
                $pd->posisi = $data_kepala[1];
                $pd->divisi = $data_kepala[2];
                $pd->prioritas = $request->prioritas;
                $pd->file = $fileName;
                $pd->status_projek = $request->status_projek;
                $pd->save();
            }
        }

        // if (is_array($request->nama_anggota)) {
        //     foreach ($request->nama_anggota as $nama) {
        //         $anggota = new AnggotaProjek();
        //         $anggota->id_projek = $data->id;
        //         $anggota->nm_anggota = $nama;
        //         $anggota->save();
        //     }
        // }

        // $file = new ProjekDetail();
        // $file->file = $fileName;
        // $file->save();

        // foreach ($request->nama_anggota as $nama) {
        //     $anggota = new AnggotaProjek();
        //     $anggota->id_projek = $data->id;
        //     $anggota->nm_anggota = $nama;
        //     $anggota->save();
        // }

        // foreach ($request->kepala_projek as $kepala) {
        //     $kpl = new KepalaProjek();
        //     $kpl->id_projek = $data->id;
        //     $kpl->nm_anggota = $kepala;
        //     $kpl->save();
        // }

        // dd($request->all());
        // dd($data->all());
        // dd($file->all());
        return redirect()->route('proyek');
    }

    public function detailprojek(Request $request, $id): View
    {
        $project = Projek::find($id);

        $totalProjek = KepalaProjek::groupBy('nm_anggota')
            ->count('id_projek');

        $totalTugas = Tugas::groupBy('tugas_dari')
            ->count('id');

        $detailProject = ProjekDetail::select('projek_details.*')
            ->where('id_projek', $id)
            ->get();

        $dataProjek = projek::select('projeks.*')
            ->where('id', $id)
            ->get();

        $tugasProjek = projek::join('tugas_untuks', 'tugas_untuks.id_projek', '=', 'projeks.id')
            ->where('tugas_untuks.id_projek', $id)
            ->get();

        $anggotaProjek = AnggotaProjek::where('id_projek', $id)
            ->get();

        $kepalaProjek = DB::table('kepala_projeks')
            ->where('id_projek', $id)
            ->get();

        // dd($request->all());
        return view('su.proyek.detailproyek', compact('totalProjek', 'totalTugas', 'detailProject', 'dataProjek', 'kepalaProjek', 'tugasProjek', 'anggotaProjek'));
    }

    public function simpankomentar(Request $request, $id)
    {
        $project = Projek::find($id);

        $data['id_projek'] = $project->id;
        $data['pesan'] = $request->pesan;
        $data['penulis'] = $request->penulis;

        $projekDetail = new ProjekDetail($data);
        $projekDetail->save();

        // dd($request->all());
        return redirect()->route('proyek');
    }

    public function downloadfile($file)
    {
        $path = storage_path('storage/file/file_projek/' . $file);

        if (file_exists($path)) {
            return Response::download($path);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }


    // ================================  END MENU PROJEK  ================================ //


    public function kanban()
    {
        return view('su.kanban.kanban');
    }

    // ================================  MENU TUGAS  ================================== //

    public function task()
    {
        $lead = Auth::user();
        $total = Tugas::count();
        $TaskBerlangsung = Tugas::where('status_tugas', 'Baru')->count();

        $dataTugas = Tugas::select('tugas_anggotas.*')
            // ->where('tugas_anggotas.tugas_dari',  $lead->user_name)
            ->get();

        $dataTugasAnggota = Tugas::select('tugas_anggotas.*')
            // ->where('tugas_anggotas.tugas_dari', $lead->user_name)
            ->where('tugas_anggotas.tugas_dari', '!=', $lead->user_name)
            ->get();

        $dataPel = projek::select('projeks.*')
            ->get();

        $dataProject = Projek::join('kepala_projeks', 'kepala_projeks.id_projek', '=', 'projeks.id')
            ->where('kepala_projeks.nm_anggota')
            ->get();

        $staffs = DB::table('anggotas')
            ->select('anggotas.*')
            // ->where('posisi', 'Staff')
            ->get();

        $kepala = DB::table('anggotas')
            ->select('anggotas.*')
            ->where('posisi', 'Manager')
            ->get();

        // return view('su.tugas.tugas', compact('dataTugas', 'staffs', 'total', 'TaskBerlangsung'));
        return view('su.tugas.tugas', compact('total', 'TaskBerlangsung', 'dataTugas', 'staffs', 'kepala', 'dataProject', 'dataPel', 'dataTugasAnggota'));
    }

    public function simpantugas(Request $request)
    {
        $data = new Tugas();
        $data->projek_tugas = $request->projek_tugas;
        // $data->judul_tugas = $request->judul_tugas;
        // $data->nm_pelanggan = $request->nm_pelanggan;
        $data->deskripsi_tugas = $request->deskripsi_tugas;
        $data->status_tugas = $request->status_tugas;
        $data->prioritas_tugas = $request->prioritas_tugas;
        $data->ditugaskan = json_encode($request->ditugaskan);
        // $data->mengetahui = json_encode($request->mengetahui);
        // $data->dibuat_tanggal = $request->dibuat_tanggal;
        $data->tenggat_waktu = $request->tenggat_waktu;
        $data->tugas_dari = $request->tugas_dari;
        // $data->mengetahui = json_encode($request->mengetahui);
        // $data->ditugaskan = json_encode($request->ditugaskan);
        $data->save();

        if (is_array($request->ditugaskan)) {
            foreach ($request->ditugaskan as $nama) {
                $anggota = new TugasUntuk();
                // $anggota->id_projek = $data->id;
                $anggota->id_tugas = $data->id;
                $anggota->tugas_dari = $data->tugas_dari;
                $anggota->penerima_tugas = $nama;
                $anggota->save();
            }
        }

        if (is_array($request->mengetahui)) {
            foreach ($request->mengetahui as $kepala) {
                $kpl = new TugasDari();
                $kpl->id_tugas = $data->id;
                $kpl->tugas_dari = $data->tugas_dari;
                $kpl->mengetahui = $kepala;
                $kpl->save();
            }
        }

        if (is_array($request->ditugaskan)) {
            foreach ($request->ditugaskan as $kepala) {
                $data_kepala = explode(' - ', $kepala);
                $kpl = new KepalaProjek();
                $kpl->id_tugas = $data->id;
                $kpl->nm_anggota = $data_kepala[0]; // Nama anggota
                $kpl->divisi = $data_kepala[2];
                $kpl->dibuat_oleh = $data->dibuat_oleh;
                $kpl->save();
            }
        }

        // dd($request->all());
        return redirect()->route('task');
    }

    public function detailtugas($id): View
    {
        $dataTugas = Tugas::where('id', $id)->get();

        $tugasUntuk = TugasUntuk::where('id_tugas', $id)
            ->get();

        $megetahui = Tugas::where('id', $id)->get();

        $detaiTugas = TugasDetail::select('tugas_details.*')
            ->get();

        // $dataTugas = Tugas::where('id', $id)->get();
        // $task = Tugas::find($id);
        // $dataProjek = projek::select('projeks.*')->get();
        // $dataTugas = Tugas::select('tugas_anggotas.*')->get();
        // $tugasUntuk = TugasUntuk::findOrFail($id)
        //     ->get();
        // $megetahui = Tugas::findOrFail($id)
        //     ->get();
        // $anggota = Anggota::select('anggotas.*')->get();

        return view('su.tugas.detailtugas', compact('dataTugas', 'tugasUntuk', 'megetahui', 'detaiTugas'));
    }

    public function simpankomentartugas(Request $request, $id)
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
        return redirect()->route('task');
    }

    // ===============================  END MENU TUGAS  ================================== //

    // ==================================  MENU ANGGOTA  ================================== // 
    public function anggota()
    {
        $users = User::all();
        $anggota = Anggota::all();

        return view('su.anggota.anggota', compact('users', 'anggota'));
    }

    public function simpananggota(Request $request)
    {
        User::updateOrInsert(
            ['email' => $request->email],
            [
                'user_name' => $request->user_name,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id
            ],

        );

        Anggota::updateOrInsert(
            [
                'id_karyawan' => $request->id_karyawan,
                'user_name' => $request->user_name,
                'divisi' => $request->divisi,
                'email' => $request->email,
                'posisi' => $request->posisi,
                'password' => bcrypt($request->password),
                'jabatan' => $request->jabatan,
                'dibuat_oleh' => $request->dibuat_oleh,
            ],
        );
        // dd($request->all());
        return redirect()->route('anggota');
    }

    // ==================================  MENU ANGGOTA  ================================== // 

    public function tiket()
    {
        return view('su.tiket.tiket');
    }

    public function laporan()
    {
        return view('su.laporan.laporan');
    }
}
