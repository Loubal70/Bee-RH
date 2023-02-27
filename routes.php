<?php

use Themosis\Support\Facades\Route;

/**
 * Plugin custom routes.
 */

Route::any('singular', ['questionnaire', function () {
    if ($user = wp_get_current_user()) {
        // TODO Add Employee
        if (in_array('administrator', $user->roles)) {
            return view('questionnaire.single');
        }
        return redirect(home_url());
    }

}]);

Route::post('/testlouis', [\Themosis\BeeRH\Controllers\SaveQuizController::class, 'store']);