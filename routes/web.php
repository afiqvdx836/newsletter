<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;

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

Auth::routes();

Route::prefix('admin')->middleware(['is_admin','is_admin'])->group(function(){

    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');

    // Newsletter
    Route::get('/newsletter/index', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::get('/newsletter/create', [NewsletterController::class, 'create'])->name('newsletter.create');
    Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');
    Route::get('/newsletter/edit/{id}', [NewsletterController::class, 'edit'])->name('newsletter.edit');
    Route::post('/newsletter/update/', [NewsletterController::class, 'update'])->name('newsletter.update');

    Route::get('newsletter/delete/{id}', [NewsletterController::class, 'delete'])->name('newsletter.delete');
    Route::get('newsletter/restore/one/{id}', [NewsletterController::class, 'restore'])->name('newsletter.restore');



});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


