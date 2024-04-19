<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BackEnd\{
    DashboardController,
    LayananController,
    DataPetugasController,
    DataUserController,
    DataCabangController,
    DataGolonganController,
    DataBidangController,
    DataLootController,
    PengaduanController,
    TanggapanController
};

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\TelegramBotController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/login', [AuthController::class, 'index']);
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/isEmailExist', [AuthController::class, 'isEmailExist'])->name('isEmailExist');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('proses.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('proses.logout');

Route::group(['prefix' => 'site'], function () {

});

Route::group(['middleware' => ['auth', 'rolecheck:admin,frontdesk,petugas,kasubbag,kepala,kasi']], function () {
    Route::group(['prefix' => '/panel'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/kategori', [LayananController::class, 'cmtq'])->name('panel.cmtq');
        Route::get('/kategori/final', [LayananController::class, 'cmtqfinal'])->name('panelfinal.cmtq');
		Route::get('/score', [SiteController::class, 'score'])->name('staff.score');
        Route::get('/kategori/{id}', [LayananController::class, 'nilai'])->name('panel.nilai');
        Route::get('/kategori/final/{id}', [LayananController::class, 'nilaifinal'])->name('panelfinal.nilai');
        Route::get('/layanan/nilaiPDF/{id}', [LayananController::class, 'createPDF'])->name('print.laporan');
        Route::get('/layanan/nilaiPDF/final/{id}', [LayananController::class, 'createPDFfinal'])->name('print.laporanfinal');
        Route::get('/layanan/nilai2PDF/{id}', [LayananController::class, 'createPDF2'])->name('print.laporan2');
        Route::get('/layanan/nilai2PDF/final/{id}', [LayananController::class, 'createPDF2final'])->name('print.laporan2final');
        Route::get('/layanan/finalisPDF/{id}', [LayananController::class, 'createFinalis'])->name('print.finalis');
        //masterdata
			Route::get('/masterdata/users', [DataUserController::class, 'index'])->name('data.users');
			Route::get('/masterdata/petugas', [DataPetugasController::class, 'index'])->name('data.petugas');
			Route::get('/masterdata/cabang', [DataCabangController::class, 'index'])->name('data.cabang');
			Route::get('/masterdata/cabang/golongan/{id}', [DataGolonganController::class, 'index'])->name('data.golongan');
			Route::get('/masterdata/cabang/golongan/bidang/{id}', [DataBidangController::class, 'index'])->name('data.bidang');
			Route::get('/masterdata/loot', [DataLootController::class, 'index'])->name('data.loot');
			Route::get('/masterdata/activity', [DataLootController::class, 'cekaktivity'])->name('data.activity');
			Route::get('/masterdata/loot/{id}', [DataLootController::class, 'ceknocabang'])->name('cekno.cabang');
    });
});

//masterdata
Route::group(['middleware' => ['auth', 'rolecheck:admin']], function () {
    Route::group(['prefix' => '/panel'], function () {
        Route::group(['prefix' => '/masterdata'], function () {
            //users
            Route::get('/users/create', [DataUserController::class, 'create'])->name('create.user');
            Route::post('/users/create', [DataUserController::class, 'store'])->name('store.user');
            Route::get('users/edit/{id}', [DataUserController::class, 'edit'])->name('edit.user');
            Route::put('/users/update/{id}', [DataUserController::class, 'update'])->name('update.user');
            Route::delete('/users/delete/{id}', [DataUserController::class, 'destroy'])->name('destroy.user');
            //petugas
            Route::get('/petugas/create', [DataPetugasController::class, 'create'])->name('create.petugas');
            Route::post('/petugas/create', [DataPetugasController::class, 'store'])->name('store.petugas');
            Route::get('petugas/edit/{id}', [DataPetugasController::class, 'edit'])->name('edit.petugas');
            Route::put('/petugas/update/{id}', [DataPetugasController::class, 'update'])->name('update.petugas');
            Route::delete('/petugas/delete/{id}', [DataPetugasController::class, 'destroy'])->name('destroy.petugas');
			//cabang
			Route::get('/cabang/create', [DataCabangController::class, 'create'])->name('create.cabang');
            Route::post('/cabang/create', [DataCabangController::class, 'store'])->name('store.cabang');
            Route::get('cabang/edit/{id}', [DataCabangController::class, 'edit'])->name('edit.cabang');
            Route::put('/cabang/update/{id}', [DataCabangController::class, 'update'])->name('update.cabang');
            Route::delete('/cabang/delete/{id}', [DataCabangController::class, 'destroy'])->name('destroy.cabang');
			//golongan
			Route::get('/golongan/create/{id}', [DataGolonganController::class, 'create'])->name('create.golongan');
            Route::post('/golongan/create/', [DataGolonganController::class, 'store'])->name('store.golongan');
            Route::get('golongan/edit/{id}', [DataGolonganController::class, 'edit'])->name('edit.golongan');
            Route::put('/golongan/update/{id}', [DataGolonganController::class, 'update'])->name('update.golongan');
            Route::delete('/golongan/delete/{id}', [DataGolonganController::class, 'destroy'])->name('destroy.golongan');
			//bidang
			Route::get('/bidang/create/{id}', [DataBidangController::class, 'create'])->name('create.bidang');
            Route::post('/bidang/create/', [DataBidangController::class, 'store'])->name('store.bidang');
            Route::get('bidang/edit/{id}', [DataBidangController::class, 'edit'])->name('edit.bidang');
            Route::put('/bidang/update/{id}', [DataBidangController::class, 'update'])->name('update.bidang');
            Route::delete('/bidang/delete/{id}', [DataBidangController::class, 'destroy'])->name('destroy.bidang');
			//loot
			Route::get('/cekloot', [DataLootController::class, 'cekloot'])->name('cek.loot');
			Route::delete('/cekloot/{id}', [DataLootController::class, 'destroy'])->name('destroy.loot');
        });
    });
});

Route::group(['middleware' => ['auth', 'rolecheck:user']], function () {
    Route::group(['prefix' => 'site'], function () {
        Route::get('/sukses', [SiteController::Class, 'success'])->name('success');
        //  pengaduan
        //Route::get('/subbagian', [SiteController::Class, 'requesting']);
        Route::get('/nomorloot', [SiteController::Class, 'nomorloot'])->name('nomor.loot');
		Route::get('/noloot/{id}', [SiteController::Class, 'createnoloot'])->name('buat.noloot');
		Route::post('/noloot/{id}/input', [SiteController::Class, 'storenoloot'])->name('store.noloot');
		Route::get('/noloott/{id}', [SiteController::Class, 'takenoloot'])->name('take.noloot');
		Route::post('/noloott/{id}', [SiteController::Class, 'updatenoloot'])->name('update.noloot');
        Route::get('/cmtq', [SiteController::Class, 'cmtq'])->name('cmtq');
		Route::get('/score', [SiteController::class, 'score'])->name('score');
		Route::get('/scorefinal', [SiteController::class, 'scorefinal'])->name('scorefinal');
		Route::get('/layanan/{id}', [SiteController::Class, 'create'])->name('buat.layanan');
        Route::post('/layanan/{id}/input', [SiteController::Class, 'store'])->name('pengaduan.store');
        Route::post('/editrank/input', [SiteController::Class, 'editstore'])->name('edit.store');
        Route::post('/editrankfinal/input', [SiteController::Class, 'editstorefinal'])->name('edit.storefinal');
		Route::get('/ranking', [SiteController::class, 'ranking'])->name('ranking');
		Route::get('/cover', [SiteController::class, 'cover'])->name('cover');
		Route::get('/ranking/{id}', [SiteController::class, 'rankingmtq'])->name('ranking.mtq');
		Route::get('/rankingfinal/{id}', [SiteController::class, 'rankingfinal'])->name('rankingfinal.mtq');
		Route::get('/deleterank/{id}', [SiteController::class, 'deleterank'])->name('delete.rank');
		Route::get('/deleterankfinal/{id}', [SiteController::class, 'deleterankfinal'])->name('delete.rankfinal');
		Route::get('/editrank/{id}', [SiteController::class, 'editrank'])->name('edit.rank');
		Route::get('/editrankfinal/{id}', [SiteController::class, 'editrankfinalx'])->name('edit.rankfinal');
		Route::get('/getrank/{id}', [SiteController::class, 'getrank'])->name('getrank');
    });
});

Route::group(['middleware' => ['auth', 'rolecheck:peserta']], function () {
    Route::group(['prefix' => 'peserta'], function () {
        Route::get('/sukses', [SiteController::Class, 'success'])->name('success');
        //  peserta
        Route::get('/profil', [PesertaController::Class, 'index'])->name('profil');
        Route::post('/input', [PesertaController::Class, 'store'])->name('store.peserta');
        Route::get('/files/{id}', [PesertaController::Class, 'fileurl'])->name('fileurl');
    });
});