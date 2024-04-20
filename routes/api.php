<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    AuthController,
    PesertaController,
    PengaduanController,
    TanggapanController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*
    API using JWT for Authorization
*/
// Login 
Route::group(['prefix' => '/v1'], function () {
    Route::post('/login', [AuthController::class, 'login']);
	Route::get('/cekAuth', [AuthController::class, 'cekAuth']);
    Route::post('/refresh',  [AuthController::class, 'refresh']);
	Route::get('/getCabang', [PesertaController::class, 'getCabang']);
	Route::get('/getKategori', [PesertaController::class, 'getKategori']);
	Route::get('/cabangMTQ/info/{id}', [PesertaController::class, 'cabangMTQ']);
	Route::get('/pesertaMTQ/{id}', [PesertaController::class, 'pesertaMTQ']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
		Route::get('/cabangMTQ/reg/{id}', [PesertaController::class, 'cabangMTQ']);
		Route::post('/regpeserta', [AuthController::class, 'reqPeserta']);
		Route::post('/savePeserta', [AuthController::class, 'savePeserta']);
		Route::get('/getBerkas/{id}', [PesertaController::class, 'getBerkas']);
		Route::post('/uploadSyarat', [PesertaController::class, 'uploadSyarat']);
		Route::post('/deleteSyarat', [PesertaController::class, 'deleteSyarat']);
        // logout
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
