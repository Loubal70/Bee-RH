<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;



function connectionDatabase()
{
    $result = [
        'error_log' => '',
        'connection' => null,
    ];

    // Instancier la connexion à la base de données
    $capsule = new Capsule;
    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => DB_HOST,
        'database' => DB_NAME,
        'username' => DB_USER,
        'password' => DB_PASSWORD,
        'charset' => DB_CHARSET,
        'collation' => DB_COLLATE,
        'prefix' => DB_PREFIX,
    ]);

    try {
        $capsule->getConnection()->getPdo();

        // Démarrer Eloquent
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $result['connection'] = $capsule;

    } catch (\Exception $e) {
        $result['error_log'] = __('Impossible de se connecter à la base de données : ', BEE_RH_TD) . $e->getMessage();
    }

    return $result;
}

function checkDatabase()
{
    $capsule = connectionDatabase();

    if (is_string($capsule)) {
        // Afficher l'erreur si la connexion à la base de données a échoué
        error_log($capsule);
    } else {
        // Créer la table si elle n'existe pas déjà
        if (!Capsule::schema()->hasTable('rh_questionnaires')) {
            Capsule::schema()->create('rh_questionnaires', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->text('results');
                $table->timestamps();
            });
        }
    }
}

register_activation_hook(__FILE__, 'checkDatabase');