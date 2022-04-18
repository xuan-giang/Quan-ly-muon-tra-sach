<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacultyController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    return view('admin.index');

})->name('dashboard');


// FACULTY

Route::prefix('faculty')->group(function () {

    Route::get('/view', [FacultyController::class, 'facultyView'])->name('faculty.view');

    Route::get('/view/{id}', [FacultyController::class, 'facultyDetailView'])->name('faculty.detail.view');

    Route::get('/add', [FacultyController::class, 'facultyAdd'])->name('faculty.add');

    Route::post('/store', [FacultyController::class, 'facultyStore'])->name('faculty.store');

    Route::get('/edit/{id}', [FacultyController::class, 'facultyEdit'])->name('faculty.edit');

    Route::post('/update/{id}', [FacultyController::class, 'facultyUpdate'])->name('faculty.update');

    Route::get('/delete/{id}', [FacultyController::class, 'facultyDelete'])->name('faculty.delete');

});
// CATEGORY

Route::prefix('category')->group(function () {

    Route::get('/view', [CategoryController::class, 'categoryView'])->name('category.view');

    Route::get('/add', [CategoryController::class, 'categoryAdd'])->name('category.add');

    Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store');

    Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');

    Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');

    Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');

});
