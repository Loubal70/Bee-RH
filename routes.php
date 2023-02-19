<?php

use Themosis\Support\Facades\Route;

/**
 * Plugin custom routes.
 */

Route::any('singular', ['questionnaire', function () {
    return view('questionnaire.single');
}]);