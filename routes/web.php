<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\FrontOfficeController;
use App\Http\Controllers\PostProfilController;
use App\Http\Controllers\PostRFCController;
use App\Http\Controllers\PostBeritaController;
use App\Http\Controllers\PostLayananController;
use App\Http\Controllers\PostAduanSiberController;
use App\Http\Controllers\PostEventController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginSSOController;
use App\Models\File;

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
    $data = File::whereNotNull('cover')
    ->get();

    $data2 = File::latest('created_at')
    ->limit(1)
    ->get();

    $data3 = File::orderBy('hit', 'desc')
    ->limit(1)
    ->get();

    return view('pages.home',compact('data','data2','data3'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/generate-uuid', [HomeController::class, 'generateuuid']);
// Route::get('/generate-slug', [HomeController::class, 'generateslug']);

Route::get('/produk', [HomeController::class, 'produk'])->name('produk');
Route::get('/listproduk', [HomeController::class, 'listproduk'])->name('listproduk');
Route::get('/detailproduk', [HomeController::class, 'detailproduk'])->name('detailproduk');
Route::get('/pdf/{uuid}', [HomeController::class, 'pdfviewer'])->name('pdf');
Route::get('/detail/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::get('download/{uuid}', [HomeController::class, 'downloadfile'])->name('file.download');
// Route::get('search', [HomeController::class, 'searchfile'])->name('file.search');
Route::post('search', [HomeController::class,'search'])->name('search');
Route::get('notfound', [HomeController::class,'notfound'])->name('notfound');

/*
|--------------------------------------------------------------------------
| Routes Group - Login SSO Bappenas 
|--------------------------------------------------------------------------
|
| Berikut route group untuk akses login SSO Bappenas. 
| Dan semua route di grouping agar rapi dan mudah dalam maintenance.
|
*/

Route::get('/kms/home', [HomeController::class, 'index'])->name('home.kms');
Route::get('/kms/ott', [LoginController::class, 'index'])->name('home.login.sso');
Route::get('/sso-bappenas', [LoginSSOController::class, 'login'])->name('login.sso');
Route::post('/logout-sso', [LoginSSOController::class, 'logout'])->name('logout.sso');
// Route::get('/logout-sso', [LoginSSOController::class, 'logout'])->name('logout.sso');
Route::get('/unathorized-page', function () { return view('front-office.pages.unathorized_page'); 
});
Route::get('/deactive-page', function () { return view('errors.deactive_user_page'); 
});



/*
|--------------------------------------------------------------------------
| Routes Group - Halaman Front Office 
|--------------------------------------------------------------------------
|
| Berikut route group untuk halaman front office. 
| Dan semua route di grouping agar rapi dan mudah dalam maintenance.
|
*/


// Route::get('/', [FrontOfficeController::class,'index'])->name('front-office');
// Route::get('/profil/definisi', [PostProfilController::class,'pageDefinisi'])->name('front.profil.definisi');
// Route::get('/profil/visi-misi', [PostProfilController::class,'pageVisiMisi'])->name('front.profil.visi-misi');

// Route::get('/rfc/informasi-dokumen', [PostRFCController::class,'pageInformasiDokumen'])->name('front.rfc.informasi-dokumen');
// Route::get('/rfc/informasi-kontak', [PostRFCController::class,'pageInformasiKontak'])->name('front.rfc.informasi-kontak');
// Route::get('/rfc/tentang-bappenas-csirt', [PostRFCController::class,'pageTentangBappenasCSIRT'])->name('front.rfc.tentang-bappenas-csirt');
// Route::get('/rfc/layanan-bappenas-csirt', [PostRFCController::class,'pageLayananBappenasCSIRT'])->name('front.rfc.layanan-bappenas-csirt');
// Route::get('/rfc/kebijakan', [PostRFCController::class,'pageKebijakan'])->name('front.rfc.kebijakan');
// Route::get('/rfc/pelaporan-insiden', [PostRFCController::class, 'pagePelaporanInsiden'])->name('front.rfc.pelaporan-insiden');
// Route::get('/rfc/disclaimer', [PostRFCController::class, 'pageDisclaimer'])->name('front.rfc.disclaimer');

// Route::get('/berita', [PostBeritaController::class,'getDataBerita'])->name('front.berita');
// Route::get('/berita/detail/{uuid}', [PostBeritaController::class,'getDataBeritaDetail'])->name('front.berita.detail');

// Route::get('/layanan/layanan-bappenas-csirt', [PostLayananController::class, 'pageLayananBappenasCSIRT'])->name('front.layanan.layanan-bappenas-csirt');
// Route::get('/layanan/panduan-teknis', [PostLayananController::class, 'pagePanduanTeknis'])->name('front.layanan.panduan-teknis');
// Route::get('/layanan/tips-keamanan-siber', [PostLayananController::class, 'pageTipsKeamananSiber'])->name('front.layanan.tips-keamanan-siber');
// Route::get('/layanan/detail/{uuid}', [PostLayananController::class, 'getDataLayananDetail'])->name('front.layanan.detail');

// Route::get('/aduan-siber', [PostAduanSiberController::class, 'pageAduanSiber'])->name('front.aduansiber');
// Route::get('/aduan-siber/detail/{uuid}', [PostAduanSiberController::class, 'getDataAduanSiberDetail'])->name('front.aduansiber.detail');

// Route::get('/event', [PostEventController::class, 'pageEvent'])->name('front.event');

// Route::get('/hubungi-kami', [PostProfilController::class, 'pageHubungiKami'])->name('front.hubungikami');

// Route::get('/page-detail', [FrontOfficeController::class, 'pagedetail']);

require __DIR__.'/auth.php';
