<?php

use Msimonoska\Translation\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;

Route::
resource('translations', TranslationController::class)
    // apply config middleware
    ->middleware(config('translation.middleware'));
