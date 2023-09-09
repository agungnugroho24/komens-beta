<?php

use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
| Routes Group - Halaman Front Office 
|--------------------------------------------------------------------------
|
| Berikut route group untuk halaman front office. 
| Dan semua route di grouping agar rapi dan mudah dalam maintenance.
|
*/
// Route::get('/.git', function(){
//   return redirect()->route('front.profil.definisi');
// });

// Route::get('/.{named}', function ($named) {
//     if (! in_array($named, ['log', 'end', 'git'])) {
//         abort(400);
//     }

// });

Route::get('/', 'FrontOfficeController@index')->name('front-office');

// Route::get('sitemap', 'XMLController@index')->name('sitemap-xml');
//Route::get('sitemap', [App\Http\Controllers\XMLController::class, 'index'])->name('sitemap-xml');


Route::get('/profil/definisi', 'PostProfilController@pageDefinisi')->name('front.profil.definisi');
Route::get('/profil/visi-misi', 'PostProfilController@pageVisiMisi')->name('front.profil.visi-misi');
// Route::get('/profil/logo', 'PostProfilController@pageLogo')->name('front.profil.logo');

Route::get('/rfc/informasi-dokumen', 'PostRFCController@pageInformasiDokumen')->name('front.rfc.informasi-dokumen');
Route::get('/rfc/informasi-kontak', 'PostRFCController@pageInformasiKontak')->name('front.rfc.informasi-kontak');
Route::get('/rfc/tentang-bappenas-csirt', 'PostRFCController@pageTentangBappenasCSIRT')->name('front.rfc.tentang-bappenas-csirt');
Route::get('/rfc/layanan-bappenas-csirt', 'PostRFCController@pageLayananBappenasCSIRT')->name('front.rfc.layanan-bappenas-csirt');
Route::get('/rfc/kebijakan', 'PostRFCController@pageKebijakan')->name('front.rfc.kebijakan');
Route::get('/rfc/pelaporan-insiden', 'PostRFCController@pagePelaporanInsiden')->name('front.rfc.pelaporan-insiden');
Route::get('/rfc/disclaimer', 'PostRFCController@pageDisclaimer')->name('front.rfc.disclaimer');

Route::get('/berita', 'PostBeritaController@getDataBerita')->name('front.berita');
Route::get('/berita/detail/{uuid}', 'PostBeritaController@getDataBeritaDetail')->name('front.berita.detail');

Route::get('/layanan/layanan-bappenas-csirt', 'PostLayananController@pageLayananBappenasCSIRT')->name('front.layanan.layanan-bappenas-csirt');
Route::get('/layanan/panduan-teknis', 'PostLayananController@pagePanduanTeknis')->name('front.layanan.panduan-teknis');
Route::get('/layanan/tips-keamanan-siber', 'PostLayananController@pageTipsKeamananSiber')->name('front.layanan.tips-keamanan-siber');
Route::get('/layanan/detail/{uuid}', 'PostLayananController@getDataLayananDetail')->name('front.layanan.detail');

Route::get('/aduan-siber', 'PostAduanSiberController@pageAduanSiber')->name('front.aduansiber');
Route::get('/aduan-siber/detail/{uuid}', 'PostAduanSiberController@getDataAduanSiberDetail')->name('front.aduansiber.detail');

Route::get('/event', 'PostEventController@pageEvent')->name('front.event');

Route::get('/hubungi-kami', 'PostProfilController@pageHubungiKami')->name('front.hubungikami');

Route::get('/page-detail', 'FrontOfficeController@pagedetail');


/*
|--------------------------------------------------------------------------
| Routes File Manager Website CSIRT 
|--------------------------------------------------------------------------
|
| Berikut route untuk akses file manager website CSIRT 
|
*/

 // Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
 Route::group(['prefix' => '/csirt-web/back-office/CSIRT-Bappenas-File-Manager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });


/*
|--------------------------------------------------------------------------
| Routes Group - Halaman Back Office 
|--------------------------------------------------------------------------
|
| Berikut route group untuk melihat halaman back office. 
| Dan semua route di grouping agar rapi dan mudah dalam maintenance.
|
*/

Route::middleware(['auth', 'check.user.active', 'check.approve'])->prefix('back-office')->group(function() {
// Route::middleware(['auth'])->prefix('back-office')->group(function() {

    Route::get('/', 'BackOfficeController@index');
    Route::get('/dashboard', 'BackOfficeController@index')->name('back-office');

    Route::prefix('profil')->group(function(){
        Route::get('/', 'PostProfilController@index')->name('post-profil');
        Route::get('/create', 'PostProfilController@create')->name('profil.create');
        Route::post('/store', 'PostProfilController@store')->name('profil.store');
        Route::get('/edit/{id}', 'PostProfilController@edit')->name('profil.edit');
        Route::put('/update/{id}', 'PostProfilController@update')->name('profil.update');
        Route::get('/delete/{id}', 'PostProfilController@destroy')->name('profil.delete');
        Route::get('/publish/{id}', 'PostProfilController@updatePublish')->name('profil.publish');
    });

    Route::prefix('berita')->group(function(){
        Route::get('/', 'PostBeritaController@index')->name('post-berita');
        Route::get('/create', 'PostBeritaController@create')->name('berita.create');
        Route::post('/store', 'PostBeritaController@store')->name('berita.store');
        Route::get('/edit/{id}', 'PostBeritaController@edit')->name('berita.edit');
        Route::put('/update/{id}', 'PostBeritaController@update')->name('berita.update');
        Route::get('/delete/{id}', 'PostBeritaController@destroy')->name('berita.delete');
        Route::get('/publish/{id}', 'PostBeritaController@updatePublish')->name('berita.publish');        
    });    

    Route::prefix('rfc-2350')->group(function(){
        Route::get('/', 'PostRFCController@index')->name('post-rfc');
        Route::get('/create', 'PostRFCController@create')->name('rfc.create');
        Route::post('/store', 'PostRFCController@store')->name('rfc.store');
        Route::get('/edit/{id}', 'PostRFCController@edit')->name('rfc.edit');
        Route::put('/update/{id}', 'PostRFCController@update')->name('rfc.update');
        Route::get('/delete/{id}', 'PostRFCController@destroy')->name('rfc.delete');
        Route::get('/publish/{id}', 'PostRFCController@updatePublish')->name('rfc.publish');
    });  

    Route::prefix('layanan')->group(function(){
        Route::get('/', 'PostLayananController@index')->name('post-layanan');
        Route::get('/create', 'PostLayananController@create')->name('layanan.create');
        Route::post('/store', 'PostLayananController@store')->name('layanan.store');
        Route::get('/edit/{id}', 'PostLayananController@edit')->name('layanan.edit');
        Route::put('/update/{id}', 'PostLayananController@update')->name('layanan.update');
        Route::get('/delete/{id}', 'PostLayananController@destroy')->name('layanan.delete');
        Route::get('/publish/{id}', 'PostLayananController@updatePublish')->name('layanan.publish');        
    }); 

    Route::prefix('aduan-siber')->group(function(){
        Route::get('/', 'PostAduanSiberController@index')->name('post-aduansiber');
        Route::get('/create', 'PostAduanSiberController@create')->name('aduansiber.create');
        Route::post('/store', 'PostAduanSiberController@store')->name('aduansiber.store');
        Route::get('/edit/{id}', 'PostAduanSiberController@edit')->name('aduansiber.edit');
        Route::put('/update/{id}', 'PostAduanSiberController@update')->name('aduansiber.update');
        Route::get('/delete/{id}', 'PostAduanSiberController@destroy')->name('aduansiber.delete');
        Route::get('/publish/{id}', 'PostAduanSiberController@updatePublish')->name('aduansiber.publish');
    });   

    Route::prefix('event')->group(function(){
        Route::get('/', 'PostEventController@index')->name('post-event');
        Route::get('/create', 'PostEventController@create')->name('event.create');
        Route::post('/store', 'PostEventController@store')->name('event.store');
        Route::get('/edit/{id}', 'PostEventController@edit')->name('event.edit');
        Route::put('/update/{id}', 'PostEventController@update')->name('event.update');
        Route::get('/delete/{id}', 'PostEventController@destroy')->name('event.delete');
        Route::get('/publish/{id}', 'PostEventController@updatePublish')->name('event.publish');
    });   

    Route::prefix('user')->group(function(){
        Route::get('/', 'AdministrasiUserController@index')->name('administrasi-user');
        Route::get('/approved/{id}', 'AdministrasiUserController@updateApproved')->name('administrasi-user.approved');
        Route::get('/active/{id}', 'AdministrasiUserController@updateActive')->name('administrasi-user.active');
    });        
 
});

Route::middleware('is.ajax.request')->prefix('back-office')->group(function () {
// Route::prefix('back-office')->group(function () {
    Route::prefix('json')->group(function () {
        Route::get('/profil', 'PostProfilController@getDatatablesJson');
        Route::get('/berita', 'PostBeritaController@getDatatablesJson');
        Route::get('/rfc', 'PostRFCController@getDatatablesJson');
        Route::get('/layanan', 'PostLayananController@getDatatablesJson');
        Route::get('/aduan-siber', 'PostAduanSiberController@getDatatablesJson');
        Route::get('/event', 'PostEventController@getDatatablesJson');
        Route::get('/front-event', 'PostEventController@getDatatablesJsonFront');
        Route::get('/administrasi-user', 'AdministrasiUserController@getDatatablesJson');
    });
});

Auth::routes(['login' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/csirt/home', 'HomeController@index')->name('home.csirt');
Route::get('/csirt/ott', 'Auth\LoginController@index')->name('home.login.sso');
Route::get('/sso-bappenas', 'Auth\LoginSSOController@login')->name('login.sso');
Route::post('/logout-sso', 'Auth\LoginSSOController@logout')->name('logout.sso');
Route::get('/unathorized-page', function () { return view('front-office.pages.unathorized_page'); 
});
Route::get('/deactive-page', function () { return view('errors.deactive_user_page'); 
});
/*
|--------------------------------------------------------------------------
| Overwrite Auth Routes Group 
|--------------------------------------------------------------------------
|
| Berikut route route yang di overwrite karena perbedaan kebutuhan pengembangan. 
| Route dibawah merupakan route bawaan package Laravel UI Authentication. 
| Dan semua route di grouping agar rapi dan mudah dalam maintenance.
|
*/

Route::get('/login', 'FrontOfficeController@redirectOverwriteRoute');
Route::post('/login', 'FrontOfficeController@redirectOverwriteRoutePost');
Route::get('/register', 'FrontOfficeController@redirectOverwriteRoute');
Route::post('/register', 'FrontOfficeController@redirectOverwriteRoutePost');
Route::get('/password/reset', 'FrontOfficeController@redirectOverwriteRoute');
Route::post('/password/email', 'FrontOfficeController@redirectOverwriteRoutePost');
Route::get('/password/reset/{token}', 'FrontOfficeController@redirectOverwriteRoute');
Route::post('/password/reset', 'FrontOfficeController@redirectOverwriteRoutePost');
Route::get('/password/confirm', 'FrontOfficeController@redirectOverwriteRoute');
Route::post('/password/confirm', 'FrontOfficeController@redirectOverwriteRoutePost');
Route::get('/email/verify', 'FrontOfficeController@redirectOverwriteRoute');
Route::get('/email/verify/{id}/{hash}', 'FrontOfficeController@redirectOverwriteRoute');
Route::post('/email/resend', 'FrontOfficeController@redirectOverwriteRoutePost');


Route::fallback(function () {
    //return view('errors.page_error');
});
