<?php

use App\Http\Controllers\EmpController;
use App\Http\Controllers\MgrController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuDashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/', function () {
    return view('su.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    // SUPERADMIN
    Route::get('/Dashboard-Admin', [UserController::class, 'su'])->name('dashboard');

    Route::get('/Agenda', [SuDashboardController::class, 'agenda'])->name('agenda');

    // =========================================  MENU PROYEK  ============================================== //

    Route::get('/Proyek', [SuDashboardController::class, 'proyek'])->name('proyek');
    Route::get('/Tambah-Projek', [SuDashboardController::class, 'buatproyek'])->name('tambah.proyek');
    Route::post('/Simpan-Projek', [SuDashboardController::class, 'simpanproyek'])->name('simpan.proyek');
    Route::get('/Detail-Projek/{id}', [SuDashboardController::class, 'detailprojek'])->name('detail.projek');
    Route::post('/Simpan-Komentar-Projek/{id}', [SuDashboardController::class, 'simpankomentar'])->name('simpan.komentar');
    Route::get('/Download-File/{file}', [SuDashboardController::class, 'downloadfile'])->name('download.file');

    // =======================================  END MENU PROYEK  ============================================ //

    // Route::get('/Detail-Proyek', [SuDashboardController::class, 'detailproyek'])->name('detailproyek');
    Route::get('/Kanban', [SuDashboardController::class, 'kanban'])->name('kanban');

    // =========================================  MENU TUGAS  ============================================== //

    Route::get('/Tugas', [SuDashboardController::class, 'task'])->name('task');
    Route::post('/Simpan-Tugas', [SuDashboardController::class, 'simpantugas'])->name('simpan.tugas');
    Route::get('/Detail-Tugas/{id}', [SuDashboardController::class, 'detailtugas'])->name('detail.tugas');
    Route::post('/Simpan-Komentar-Tugas/{id}', [SuDashboardController::class, 'simpankomentartugas'])->name('simpan.komentar.tugas');

    // =======================================  END MENU PROYEK  ============================================ //

    // ======================================  MENU ANGGOTA  ====================================== //

    Route::get('/Anggota', [SuDashboardController::class, 'anggota'])->name('anggota');
    Route::post('/Simpan-Anggota', [SuDashboardController::class, 'simpananggota'])->name('simpan.anggota');

    // ====================================  END MENU ANGGOTA  ==================================== //
    Route::get('/Tiket', [SuDashboardController::class, 'tiket'])->name('tiket');
    Route::get('/Laporan', [SuDashboardController::class, 'laporan'])->name('laporan');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ======================================  MENU MANAGER  ====================================== //

    Route::get('/Dashboard-Manager', [UserController::class, 'manager'])->name('dashboard');
    Route::get('/Projek-Manager', [MgrController::class, 'projekmgr'])->name('projek.mgr');
    Route::get('/Tambah-Projek-Manager', [MgrController::class, 'buatprojekmgr'])->name('tambah.proyek.mgr');
    Route::get('/Detail-Projek-Manager/{id}', [MgrController::class, 'detailprojekmgr'])->name('detail.projek.mgr');
    Route::get('/Detail-SubProjek-Manager/{id}', [MgrController::class, 'detailsubprojekmgr'])->name('detail.subprojek.mgr');
    Route::post('/Simpan-Komentar-Projek-Manager/{id}', [MgrDashboardController::class, 'simpankomentarmgr'])->name('simpan.komentarmgr');
    Route::post('/Simpan-Projek-Manager', [MgrController::class, 'simpanprojekmgr'])->name('simpan.projekmgr');

    Route::get('/Detail-Tugas-Manager/{id}', [MgrController::class, 'detailtugasmgr'])->name('detail.tugas.mgr');
    Route::get('/Update-Tugas-Manager/{id}', [MgrController::class, 'updatetugasmgr'])->name('update.statustugas');
    Route::get('/Tugas-Manager', [MgrController::class, 'tugasmgr'])->name('tugas.mgr');
    Route::post('/Simpan-Tugas-Manager', [MgrController::class, 'simpantugasmgr'])->name('simpan.tugasmgr');
    Route::post('/Simpan-Komentar-Tugas-Manager/{id}', [MgrController::class, 'simpankomentartugasmgr'])->name('simpan.komentar.tugasmgr');

    Route::get('/Agenda-Manager', [MgrController::class, 'agendamgr'])->name('agenda.mgr');

    // ======================================  END MENU MANAGER  ====================================== //

    // ======================================  MENU ANGGOTA  ====================================== //

    
    Route::get('/Dashboard-Anggota', [UserController::class, 'employee'])->name('dashboard');

    Route::get('/Projek-Anggota', [EmpController::class, 'projekemp'])->name('projek.emp');
    Route::get('/Detail-Projek-Anggota/{id}', [EmpController::class, 'detailprojekemp'])->name('detail.projek.emp');
    Route::post('/Simpan-Komentar-Projek-Anggota/{id}', [EmpController::class, 'simpankomentaremp'])->name('simpan.komentaremp');

    Route::get('/Tugas-Anggota', [EmpController::class, 'tugasemp'])->name('tugas.emp');
    Route::get('/Detail-Tugas-Anggota/{id}', [EmpController::class, 'detailtugasemp'])->name('detail.tugas.emp');
    Route::post('/Simpan-Komentar-Tugas-Anggota/{id}', [EmpController::class, 'simpankomentartugasemp'])->name('simpan.komentar.tugasemp');
    // Route::get('/Tugas-Anggota', [MgrController::class, 'tugasanggota'])->name('tugas.anggota');
    // Route::get('/Detail-Projek-Manager/{id}', [MgrController::class, 'detailprojekmgr'])->name('detail.projek.mgr');
    

    // ======================================  END MENU ANGGOTA  ====================================== //
});

require __DIR__.'/auth.php';
