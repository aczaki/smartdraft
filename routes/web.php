<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login-form', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard Admin
    
    
    // Show Template
    Route::get('/list-template', [TemplateController::class, 'showTemplate'])->name('templates.index');
    Route::get('/templates/{id}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
    Route::put('/templates/{id}', [TemplateController::class, 'update'])->name('templates.update');
    Route::delete('/templates/{id}', [TemplateController::class, 'destroy'])->name('templates.destroy');
    // Upload Template
    Route::get('/form-template', [TemplateController::class, 'index']);
    Route::post('/upload-template', [TemplateController::class, 'upload'])->name('uploadTemplate');
    // Kelola Pengguna
    Route::get('/list-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');

});

Route::middleware(['auth', 'user'])->group(function () {

    //Dashboard User
    Route::get('/dashboard', [ArsipController::class, 'dashboard'])->name('dashboard');

    //Generate surat
    Route::get('/surat', [SuratController::class, 'showForm'])->name('surat.form');
    Route::post('/generate-surat', [SuratController::class, 'generate']);
    //preview Surat
    Route::get('/preview-surat', [SuratController::class, 'preview'])->name('surat.preview');
    Route::get('/download-surat/{filename}', function ($filename) {
        $path = storage_path('app/public/generated/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    })->name('download.surat');

    //Arsip
    Route::post('/arsip-surat', [ArsipController::class, 'store'])
        ->name('arsip.store');
    Route::get('/list-arsip', [ArsipController::class, 'show'])
        ->name('arsip.index');
    Route::get('/arsip-surat/{id}/edit', [ArsipController::class, 'edit'])
        ->name('arsip.edit');
    Route::put('/arsip-surat/{id}', [ArsipController::class, 'update'])
        ->name('arsip.update');
    Route::delete('/arsip-surat/{id}', [ArsipController::class, 'destroy'])
        ->name('arsip.destroy');
    Route::get('/arsip/export', [ArsipController::class, 'export'])
        ->name('arsip.export');

    //based
    Route::get('/based', fn () => view('surat.based'));
    Route::post('/based/generate', [SuratController::class, 'inject'])
        ->name('surat.inject');
    
});



//Upload template

// Route::post('/templates/upload', [TemplateController::class, 'store']);




// Route::get('/login', function () {
//     return view('login');
// });

