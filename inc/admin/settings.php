<?php

use Themosis\Support\Facades\Action;

class Bee_RH_Settings
{
    public function __construct()
    {
        Action::add('admin_menu', [$this, 'add_settings_page']);

    }

    public function add_settings_page()
    {
        add_options_page(
            'Amphibee RH',      // Titre de la page de réglages
            'Amphibee RH',      // Titre du menu
            'manage_options',   // Capacité requise pour accéder à la page
            'amphibee-rh',      // Slug de la page de réglages
            array($this, 'render_settings_page')   // Fonction pour afficher le contenu de la page de réglages
        );
    }

    public function render_settings_page()
    {
        // Charger le contenu de la vue
        $content = $this->load_view('settings');

        // Afficher le contenu de la page de réglages
        echo $content;
    }

    public function load_view($view)
    {
        if($view === 'settings'){
            wp_enqueue_style('bee-rh-tailwind', AMPHIBEE_RH_PLUGIN_URL . 'assets/css/tailwind.out.css');
        }

        // Charger le contenu de la vue en utilisant Blade
        $path = AMPHIBEE_RH_PLUGIN_PATH . 'views/' . $view . '.blade.php';
        $blade = new \Jenssegers\Blade\Blade(dirname($path), 'php');
        return $blade->render($view);
    }


}