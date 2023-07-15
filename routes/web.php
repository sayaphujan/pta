<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankController;

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




Auth::routes();

Route::get('/clear-cache', function(){
	$exitCode = Artisan::call('cache:clear');
});

Route::get('/clear-view', function(){
	$exitCode = Artisan::call('view:clear');
});

Route::get('/migrations', [App\Http\Controllers\Auth\ArtisanController::class,'migrations'])->name('migrations');

Route::post('file-upload', [CKEditorController::class, 'fileUpload']);

Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload');

Route::get('upload',  [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/proses',  [UploadController::class, 'proses_upload'])->name('proses_upload');


/* CREDENTIAL */
Route::get('masuk', [App\Http\Controllers\MainController::class, 'masuk'])->name('masuk');
Route::get('daftar', [App\Http\Controllers\MainController::class, 'daftar'])->name('daftar');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class,'create'])->name('signup');
Route::post('check', [App\Http\Controllers\Auth\RegisterController::class, 'check'])->name('check');
Route::get('/getprice/{id}', [App\Http\Controllers\MainController::class, 'getprice'])->name('getprice');
Route::post('pesan', [App\Http\Controllers\MainController::class, 'pesan'])->name('pesan');
Route::get('notif', [App\Http\Controllers\MainController::class, 'notif'])->name('notif');
Route::post('pay', [App\Http\Controllers\MainController::class, 'pay'])->name('pay');
Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('profile');
Route::get('/profile/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');

/* USER */
Route::post('exist', [App\Http\Controllers\UserController::class, 'check'])->name('exist');
Route::get('users',  [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users/create/', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users/store/', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::get('/users/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

/* Officer */
Route::get('/officers',  [App\Http\Controllers\OfficerController::class, 'index'])->name('officers');
Route::get('/officers/create/', [App\Http\Controllers\OfficerController::class, 'create'])->name('officers.create');
Route::post('/officers/store/', [App\Http\Controllers\OfficerController::class, 'store'])->name('officers.store');
Route::get('/officers/show/{id}', [App\Http\Controllers\OfficerController::class, 'show'])->name('officers.show');
Route::get('/officers/edit/{id}', [App\Http\Controllers\OfficerController::class, 'edit'])->name('officers.edit');
Route::put('/officers/update/{id}', [App\Http\Controllers\OfficerController::class, 'update'])->name('officers.update');
Route::get('/officers/destroy/{id}', [App\Http\Controllers\OfficerController::class, 'destroy'])->name('officers.destroy');

/* BANK */
Route::get('banks',  [App\Http\Controllers\BankController::class, 'index'])->name('banks');
Route::get('/banks/create/', [App\Http\Controllers\BankController::class, 'create'])->name('banks.create');
Route::post('/banks/store/', [App\Http\Controllers\BankController::class, 'store'])->name('banks.store');
Route::get('/banks/show/{id}', [App\Http\Controllers\BankController::class, 'show'])->name('banks.show');
Route::get('/banks/edit/{id}', [App\Http\Controllers\BankController::class, 'edit'])->name('banks.edit');
Route::put('/banks/update/{id}', [App\Http\Controllers\BankController::class, 'update'])->name('banks.update');
Route::get('/banks/destroy/{id}', [App\Http\Controllers\BankController::class, 'destroy'])->name('banks.destroy');
Route::post('find', [App\Http\Controllers\BankController::class, 'exist'])->name('find');


/* PRICE */
Route::get('prices',  [App\Http\Controllers\PriceController::class, 'index'])->name('prices');
Route::get('/prices/create/', [App\Http\Controllers\PriceController::class, 'create'])->name('prices.create');
Route::post('/prices/store/', [App\Http\Controllers\PriceController::class, 'store'])->name('prices.store');
Route::get('/prices/edit/{id}', [App\Http\Controllers\PriceController::class, 'edit'])->name('prices.edit');
Route::put('/prices/update/{id}', [App\Http\Controllers\PriceController::class, 'update'])->name('prices.update');
Route::get('/prices/destroy/{id}', [App\Http\Controllers\PriceController::class, 'destroy'])->name('prices.destroy');
Route::post('/prices/getprice/', [App\Http\Controllers\PriceController::class, 'getprice'])->name('prices.getprice');


/* Transaction */
Route::get('/trans',  [App\Http\Controllers\TransController::class, 'index'])->name('trans');
Route::get('/unverified',  [App\Http\Controllers\TransController::class, 'unverified'])->name('trans.unverified');
Route::get('/unpaid',  [App\Http\Controllers\TransController::class, 'unpaid'])->name('trans.unpaid');
Route::get('/paid',  [App\Http\Controllers\TransController::class, 'paid'])->name('trans.paid');
Route::get('/sent',  [App\Http\Controllers\TransController::class, 'sent'])->name('trans.sent');
Route::get('/unsent',  [App\Http\Controllers\TransController::class, 'unsent'])->name('trans.unsent');
Route::get('/trans/detail/{id}',  [App\Http\Controllers\TransController::class, 'detail'])->name('trans.detail');
Route::get('/trans/detail/resi/{id}',  [App\Http\Controllers\TransController::class, 'print'])->name('trans.print');
Route::put('/trans/update_status/{id}',  [App\Http\Controllers\TransController::class, 'update_status'])->name('trans.update_status');
Route::put('/trans/update_payment/{id}',  [App\Http\Controllers\TransController::class, 'update_payment'])->name('trans.update_payment');
Route::get('/trans/delivery_send/{id}',  [App\Http\Controllers\TransController::class, 'delivery_send'])->name('trans.delivery_send');
Route::get('/trans/update_status_bayar/{id}',  [App\Http\Controllers\TransController::class, 'update_status_bayar'])->name('trans.update_status_bayar');
Route::get('/trans/cancel_bayar/{id}',  [App\Http\Controllers\TransController::class, 'cancel_bayar'])->name('trans.cancel_bayar');
Route::get('/trans/update_status_kirim/{id}',  [App\Http\Controllers\TransController::class, 'update_status_kirim'])->name('trans.update_status_kirim');

//Route::get('/home', function () {
//    config(['adminlte.classes_content_wrapper' => 'kanban']);
//    config(['adminlte.classes_content' => 'container-fluid h-100 w-75']);

 //   return view('home');
//})->name('home')->middleware('auth');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'userHome'])->name('dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main.index');
Route::post('/cetak/', [App\Http\Controllers\TransController::class, 'cetak'])->name('cetak');


Route::get('pages', [App\Http\Controllers\PageController::class, 'index'])->name('pages');
Route::get('/pages/create/', [App\Http\Controllers\PageController::class, 'create'])->name('pages.create');
Route::post('/pages/store/', [App\Http\Controllers\PageController::class, 'store'])->name('pages.store');
Route::get('/pages/show/{id}', [App\Http\Controllers\PageController::class, 'show'])->name('pages.show');
Route::get('/pages/edit/{id}', [App\Http\Controllers\PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/update/{id}', [App\Http\Controllers\PageController::class, 'update'])->name('pages.update');
Route::get('/pages/destroy/{id}', [App\Http\Controllers\PageController::class, 'destroy'])->name('pages.destroy');