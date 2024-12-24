<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Doctor\DetailPeriksaController;
use App\Http\Controllers\Doctor\Auth\DoctorAuthController;
use App\Http\Controllers\Doctor\DokterController as DoctorDokterController;
use App\Http\Controllers\Doctor\JadwalPeriksaController;
use App\Http\Controllers\Doctor\PeriksaController;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\UserController;
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
    return view('welcome');
})->name('homepage');

// Route group user authentication
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    // Must be authenticated to access these routes
    Route::group(['middleware' => 'auth:pasien'], function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::POST('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/get-jadwal-by-poli/{id}', [UserController::class, 'getJadwalByPoli']);
        Route::post('/store', [UserController::class, 'store'])->name('store');
    });
    // Must be a guest to access these routes
    Route::group(['middleware' => 'guest:pasien'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'handleLogin'])->name('handlelogin');
        Route::post('/register', [AuthController::class, 'handleRegister'])->name('handleregister');
    });
});

// Route for doctor
Route::group(['prefix' => 'dokter', 'as' => 'dokter.'], function () {
    // Must be authenticated to access these routes
    Route::group(['middleware' => 'auth:dokter'], function () {
        Route::get('/dashboard', [DoctorDokterController::class, 'index'])->name('dashboard');
        Route::POST('/logout', [DoctorAuthController::class, 'logout'])->name('logout');
        Route::get('/profile/{id}', [DoctorDokterController::class, 'profile'])->name('profile');
        Route::put('/profile/{id}/update', [DoctorDokterController::class, 'updateProfile'])->name('profile.update');

        Route::get('/jadwal-periksa', [JadwalPeriksaController::class, 'index'])->name('jadwal-periksa');
        Route::post('/jadwal-periksa/store', [JadwalPeriksaController::class, 'store'])->name('jadwal-periksa.store');
        Route::put('/jadwal-periksa/update/{id}', [JadwalPeriksaController::class, 'update'])->name('jadwal-periksa.update');
        Route::delete('/jadwal-periksa/delete/{id}', [JadwalPeriksaController::class, 'destroy'])->name('jadwal-periksa.delete');

        Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa');
        Route::get('/periksa/find/{id}', [PeriksaController::class, 'find'])->name('periksa.find');
        Route::post('/periksa/store', [PeriksaController::class, 'store'])->name('periksa.store');
        Route::get('/periksa/edit/{id}', [PeriksaController::class, 'edit'])->name('periksa.edit');
        Route::put('/periksa/update/{id}', [PeriksaController::class, 'update'])->name('periksa.update');
        Route::delete('/periksa/delete/{id}', [PeriksaController::class, 'destroy'])->name('periksa.delete');

        Route::get('/detail-periksa', [DetailPeriksaController::class, 'index'])->name('detail-periksa');
        Route::get('/detail-periksa/show/{id}', [DetailPeriksaController::class, 'show'])->name('detail-periksa.show');
    });
    // Must be a guest to access these routes
    Route::group(['middleware' => 'guest:dokter'], function () {
        Route::get('/login', [DoctorAuthController::class, 'login'])->name('login');
        Route::get('/register', [DoctorAuthController::class, 'register'])->name('register');
        Route::post('/login', [DoctorAuthController::class, 'handleLogin'])->name('handlelogin');
        Route::post('/register', [DoctorAuthController::class, 'handleRegister'])->name('handleregister');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::POST('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::get('/register', [AdminController::class, 'register'])->name('register');
    Route::post('/login', [AdminController::class, 'handleLogin'])->name('handlelogin');
    Route::post('/register', [AdminController::class, 'handleRegister'])->name('handleregister');
    Route::get('/obat', [ObatController::class, 'index'])->name('obat');
    Route::post('/obat/store', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/update/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::put('/obat/update/{id}', [ObatController::class, 'handleupdate'])->name('obat.handleupdate');
    Route::delete('/obat/delete/{id}', [ObatController::class, 'delete'])->name('obat.delete');

    Route::get('/poli', [PoliController::class, 'index'])->name('poli');
    Route::post('/poli/store', [PoliController::class, 'store'])->name('poli.store');
    Route::get('/poli/update/{id}', [PoliController::class, 'update'])->name('poli.update');
    Route::put('/poli/update/{id}', [PoliController::class, 'handleupdate'])->name('poli.handleupdate');
    Route::delete('/poli/delete/{id}', [PoliController::class, 'delete'])->name('poli.delete');

    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');
    Route::get('/dokter/{id}', [DokterController::class, 'show'])->name('dokter.show');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::get('/dokter/tambah-dokter', [DokterController::class, 'tambah'])->name('dokter.tambah');
    Route::post('/dokter/store', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/update/{id}', [DokterController::class, 'edit'])->name('dokter.update');
    Route::put('/dokter/update-dokter/{id}', [DokterController::class, 'update'])->name('dokter.handleupdate');
    Route::delete('/dokter/delete/{id}', [DokterController::class, 'delete'])->name('dokter.delete');

    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien');
    Route::get('/pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien/store', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/update/{id}', [PasienController::class, 'edit'])->name('pasien.update');
    Route::put('/pasien/update/{id}', [PasienController::class, 'update'])->name('pasien.handleupdate');
    Route::delete('/pasien/delete/{id}', [PasienController::class, 'delete'])->name('pasien.delete');
});
