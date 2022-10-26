<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtworkUploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\GuestController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [GuestController::class, 'index']);


Route::get('/sitemap.xml', function () {
    return view('sitemap');
});



Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);


Route::get('/dashboard', [ArtworkUploadController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/exhibitions', [ExhibitionController::class, 'index'])->middleware(['auth'])->name('exhibitons');
Route::get('/categories', [CategoriesController::class, 'index'])->middleware(['auth'])->name('categories');

Route::post('/upload-artwork', [ArtworkUploadController::class, 'store'])->middleware(['auth'])->name('upload-artwork');
Route::delete('/delete-artwork/{id}', [ArtworkUploadController::class, 'destroy'])->middleware(['auth'])->name('delete-artwork');
Route::post('/update-artwork/{id}', [ArtworkUploadController::class, 'update'])->middleware(['auth'])->name('update-artwork');

Route::delete('/delete-category/{id}', [CategoriesController::class, 'destroy'])->middleware(['auth'])->name('delete-category');
Route::post('/upload-category', [CategoriesController::class, 'store'])->middleware(['auth'])->name('upload-category');
Route::post('/update-category/{id}', [CategoriesController::class, 'update'])->middleware(['auth'])->name('update-category');

Route::delete('/delete-exhibition/{id}', [ExhibitionController::class, 'destroy'])->middleware(['auth'])->name('delete-exhibition');
Route::post('/upload-exhibition', [ExhibitionController::class, 'store'])->middleware(['auth'])->name('upload-exhibition');
Route::post('/update-exhibition/{id}', [ExhibitionController::class, 'update'])->middleware(['auth'])->name('update-exhibition');


require __DIR__ . '/auth.php';
