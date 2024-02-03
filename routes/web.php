<?php


use App\Livewire\Dashboard;
use App\Livewire\User\Home;
use App\Livewire\Admin\Supir;
use App\Livewire\User\Kontak;
use App\Livewire\User\Produk;
use App\Livewire\User\Pesanan;
use App\Livewire\ManajemenUser;
use App\Livewire\Admin\Karyawan;
use App\Livewire\User\Keranjang;
use App\Livewire\Admin\Kendaraan;
use App\Livewire\Admin\Pelanggan;
use App\Livewire\Admin\Penjualan;
use App\Livewire\Admin\Penugasan;
use App\Livewire\Admin\JenisPasir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\Admin\LaporanPenjualan;


Auth::routes(['register' => false], ['verify' => false], ['reset' => false]);

// middleware auth
Route::group(['middleware' => 'admin'], function () {

    Route::get('/home', Dashboard::class)->name('home');

    // manajemen-user
    Route::get('/manajemen-user', ManajemenUser::class)->name('manajemen-user');
    // karyawan
    Route::get('/karyawan', Karyawan::class)->name('karyawan');
    // pelanggan
    Route::get('/pelanggan', Pelanggan::class)->name('pelanggan');
    // kendaraan
    Route::get('/kendaraan', Kendaraan::class)->name('kendaraan');
    // produk
    Route::get('/jenis-pasir', JenisPasir::class)->name('jenis-pasir');
    //penjualan
    Route::get('/penjualan', Penjualan::class)->name('penjualan');
    // penugasan
    Route::get('/penugasan', Penugasan::class)->name('penugasan');
    //laporan penjualan
    Route::get('/laporan-penjualan', LaporanPenjualan::class)->name('laporan-penjualan');
});

// user middleware
Route::get('/', Home::class)->name('user-home');
Route::group(['middleware' => 'user'], function () {
    Route::get('/produk', Produk::class)->name('user-produk');
    Route::get('/keranjang', Keranjang::class)->name('user-keranjang');
    Route::get('/pesanan', Pesanan::class)->name('user-pesanan');
    Route::get('/kontak', Kontak::class)->name('user-kontak');

    //get-geolocation
    Route::post('/get-geolocation', [HomeController::class, 'getGeolocation'])->name('get-geolocation');
});

//

