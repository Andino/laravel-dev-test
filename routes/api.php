<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SESController;

Route::post('/process-ses-event', SESController::class);
