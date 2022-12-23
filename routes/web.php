<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('newsletters.index');
});

Auth::routes();

Route::prefix('admin')->middleware(['is_admin','is_admin'])->group(function(){

    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');

    // Newsletter
    Route::get('/newsletter/index', [NewsletterController::class, 'index'])->name('admin.newsletters.index');
    Route::get('/newsletter/create', [NewsletterController::class, 'create'])->name('newsletter.create');
    Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');
    Route::get('/newsletter/edit/{id}', [NewsletterController::class, 'edit'])->name('newsletter.edit');
    Route::post('/newsletter/update/', [NewsletterController::class, 'update'])->name('newsletter.update');

    Route::get('/list', [NewsletterController::class, 'list'])->name('newsletter.list');
    Route::get('newsletter/delete/{id}', [NewsletterController::class, 'delete'])->name('newsletter.delete');
    Route::get('/newsletter/restore/one/{id}', [NewsletterController::class, 'restore'])->name('newsletter.restore');
    Route::get('/newsletter/trashed', [NewsletterController::class, 'restore'])->name('newsletter.trashed');
    Route::get('/restoreAll', [NewsletterController::class, 'restoreAll'])->name('newsletters.restore.all');

    Route::get('newsletter/recyclenewsletter/{id}', [NewsletterController::class, 'deletePermanently'])->name('newsletter.deletepermanently');





}); // end admin route


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users/newsletters', [UserController::class, 'index'])->name('newsletters.index');
Route::get('/users/newsletters/{id}', [UserController::class, 'details'])->name('newsletters.details')->middleware('auth');

// Route::get('/trigger/{data}', function ($data) {
//     Route::get('/users/newsletters', [UserController::class, 'index'])->name('newsletters.index');
//     event(new App\Events\GetRequestEvent($data));
// });

