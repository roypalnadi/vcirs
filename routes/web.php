<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'indexV2'])->name('index');
Route::post('/save', [HomeController::class, 'save'])->name('save');
Route::get('/result', [HomeController::class, 'result'])->name('result');

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');

Route::get('/list', [App\Http\Controllers\UserController::class, 'list'])->name('userList');
Route::get('/add', [App\Http\Controllers\UserController::class, 'add'])->name('userAdd');
Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('userStore');
Route::get('/view/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('userView');
Route::post('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('userEdit');
Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('userdelete');

Route::get('/penyakit/list', [App\Http\Controllers\PenyakitController::class, 'list'])->name('penyakitList');
Route::get('/penyakit/add', [App\Http\Controllers\PenyakitController::class, 'add'])->name('penyakitAdd');
Route::post('/penyakit/store', [App\Http\Controllers\PenyakitController::class, 'store'])->name('penyakitStore');
Route::get('/penyakit/view/{id}', [App\Http\Controllers\PenyakitController::class, 'view'])->name('penyakitView');
Route::post('/penyakit/edit', [App\Http\Controllers\PenyakitController::class, 'edit'])->name('penyakitEdit');
Route::get('/penyakit/delete/{id}', [App\Http\Controllers\PenyakitController::class, 'delete'])->name('penyakitdelete');

Route::get('/gejala/list', [App\Http\Controllers\GejalaController::class, 'list'])->name('gejalaList');
Route::get('/gejala/add', [App\Http\Controllers\GejalaController::class, 'add'])->name('gejalaAdd');
Route::post('/gejala/store', [App\Http\Controllers\GejalaController::class, 'store'])->name('gejalaStore');
Route::get('/gejala/view/{id}', [App\Http\Controllers\GejalaController::class, 'view'])->name('gejalaView');
Route::post('/gejala/edit', [App\Http\Controllers\GejalaController::class, 'edit'])->name('gejalaEdit');
Route::get('/gejala/delete/{id}', [App\Http\Controllers\GejalaController::class, 'delete'])->name('gejaladelete');

Route::get('/rule/list', [App\Http\Controllers\RuleController::class, 'listV2'])->name('ruleList');
Route::get('/rule/add', [App\Http\Controllers\RuleController::class, 'addV2'])->name('ruleAdd');
Route::post('/rule/store', [App\Http\Controllers\RuleController::class, 'storeV2'])->name('ruleStore');
Route::get('/rule/view/{id}', [App\Http\Controllers\RuleController::class, 'viewV2'])->name('ruleView');
Route::post('/rule/edit', [App\Http\Controllers\RuleController::class, 'editV2'])->name('ruleEdit');
Route::get('/rule/delete/{id}', [App\Http\Controllers\RuleController::class, 'deleteV2'])->name('ruledelete');

Route::get('/pilihan/list', [App\Http\Controllers\PilihanController::class, 'list'])->name('pilihanList');
Route::get('/pilihan/add', [App\Http\Controllers\PilihanController::class, 'add'])->name('pilihanAdd');
Route::post('/pilihan/store', [App\Http\Controllers\PilihanController::class, 'store'])->name('pilihanStore');
Route::get('/pilihan/view/{id}', [App\Http\Controllers\PilihanController::class, 'view'])->name('pilihanView');
Route::post('/pilihan/edit', [App\Http\Controllers\PilihanController::class, 'edit'])->name('pilihanEdit');
Route::get('/pilihan/delete/{id}', [App\Http\Controllers\PilihanController::class, 'delete'])->name('pilihandelete');

Auth::routes();
