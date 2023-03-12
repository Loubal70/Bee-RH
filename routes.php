<?php

use Themosis\Support\Facades\Route;
use Maknz\Slack\Client;


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

Route::get('/messageslack', function(){
    $url = 'https://hooks.slack.com/services/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';

    $message = array(
        'text' => 'Bonjour tout le monde test ! <!here>',
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($message)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        // Échec de l'envoi du message
        // Gérer l'erreur ici
    } else {
        // Message envoyé avec succès
    }


});