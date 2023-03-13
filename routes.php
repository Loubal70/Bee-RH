<?php

use Themosis\Support\Facades\Route;
use Themosis\BeeRH\Providers\SendSlackNotificationServiceProvider;


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

Route::post('/testlouis/{id}', [\Themosis\BeeRH\Controllers\SaveQuizController::class, 'store']);

Route::post('/bee-save/slack-webhook', [\Themosis\BeeRH\Controllers\SaveGlobalInformationController::class, 'store_slack_webhook']);

Route::get('/messageslack/', function () {
    $message = "Hello, world!";
    $mention = "here";
    SendSlackNotificationServiceProvider::send($message, $mention);
});