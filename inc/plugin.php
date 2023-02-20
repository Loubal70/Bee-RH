<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

function checkDatabase() {
    // Instancier la connexion à la base de données
    $capsule = new Capsule;
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => DB_HOST,
        'database'  => DB_NAME,
        'username'  => DB_USER,
        'password'  => DB_PASSWORD,
        'charset'   => DB_CHARSET,
        'collation' => DB_COLLATE,
        'prefix'    => env('DATABASE_PREFIX', 'wp_'),
    ]);

    // Démarrer Eloquent
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

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

register_activation_hook(__FILE__, 'checkDatabase');