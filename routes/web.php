<?php

use App\Http\Controllers\ProfileController;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', function (Request $request) {
    return view('dashboard', [
        'user' => $request->user(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/invoices', function (Request $request) {
    return view('invoices', [
        'invoices' => $request->user()->invoices,
    ]);
})->middleware(['auth', 'verified'])->name('invoices');

Route::post('/invoices/{invoice}/download', function (Invoice $invoice, Request $request) {
    return Storage::download($invoice->path);
})->middleware(['auth'])->name('invoices.download');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/api-key', [ProfileController::class, 'generateApiKey'])
        ->name('profile.generateApiKey');
    Route::post('/profile/template', [ProfileController::class, 'updateTemplate'])
        ->name('profile.updateTemplate');

    Route::get('/preview-template/{id}', \App\Http\Controllers\PdfPreviewController::class)
        ->name('previewTemplate');

    Route::put('/company', [\App\Http\Controllers\CompanyController::class, 'update'])
        ->name('company.update');
});

require __DIR__.'/auth.php';
