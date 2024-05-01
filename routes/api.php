<?php

use Illuminate\Support\Facades\Route;

Route::post('/generate-pdf', [\App\Http\Controllers\PdfController::class, 'generate']);
Route::post('/download-pdf/{invoice}', [\App\Http\Controllers\PdfController::class, 'download']);
