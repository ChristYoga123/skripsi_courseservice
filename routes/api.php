<?php

use App\Http\Controllers\KelasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('course')->group(function()
{
    Route::get('kelas', [KelasController::class, 'index']);
    Route::get('kelas/{slug}', [KelasController::class, 'getKursusBySlug']);
    Route::get('kelas/{slug}/is-created-by-user', [KelasController::class, 'checkIfKursusIsCreatedByUser']);
    Route::get('kelas/{slug}/is-joined-by-user', [KelasController::class, 'checkIfStudentIsEnrolledToCourse']);
    Route::post('kelas/{slug}/enroll', [KelasController::class, 'enrollStudentToCourse']);
});
