<?php
// Initialiser le plugin
Action::add('init', 'amphibee_rh_activation');
Action::add('plugins_loaded', function() {

    // Définir une route pour votre plugin
    Route::get('/questionnaire-archive', function() {
        $query = new WP_Query([
            'post_type' => 'questionnaire',
            'posts_per_page' => -1
        ]);
        $settings = new Bee_RH_Settings();

        $layout_path = locate_template( 'layouts/main.php' );
        $content = $settings->load_view('questionnaire.single');

        if ( $layout_path ) {
            ob_start();
            include( $layout_path );
            $layout = ob_get_clean();
        } else {
            $layout = $content;
        }

        return $layout;
    });
});
function amphibee_rh_activation()
{
    // Récupérer les informations sur le thème actif
    $theme = wp_get_theme();
    // Récupérer le chemin vers le fichier package.json du thème
    $package_file = $theme->get_stylesheet_directory() . '/package.json';

    // Vérifier la présence du fichier package.json
    if (!file_exists($package_file)) {
        // Afficher une notice d'erreur pour informer l'utilisateur
        Action::add('admin_notices', function () {
            $class = 'notice notice-error';
            $message = __('Le plugin Amphibee RH nécessite un fichier package.json dans votre thème. Veuillez l\'ajouter et réactiver le plugin.', 'amphibee-rh');
            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
        });

        // Désactiver le plugin
        deactivate_plugins(plugin_basename(__FILE__));
    }

    // Charger le contenu de package.json
    $package = json_decode(file_get_contents($package_file), true);

    // Vérifier si Alpine.js est une dépendance du thème
    if (empty($package['dependencies']['alpinejs']) || empty($package['dependencies']['tailwindcss'])) {
        // Afficher une notice d'erreur pour informer l'utilisateur
        Action::add('admin_notices', function () {
            $class = 'notice notice-error';
            $message = __('Le plugin Amphibee RH nécessite l\'utilisation de TailwindCSS et Alpine.js dans votre thème. Veuillez les ajouter et réactiver le plugin.', 'amphibee-rh');
            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
        });

        // Désactiver le plugin bee-rh/bee-rh.php
        deactivate_plugins(AMPHIBEE_RH_PLUGIN_PATH . 'bee-rh.php');
    }

    // Admin Panel
    require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
    new Bee_RH_Settings();

    // Post Type
    require_once plugin_dir_path(__FILE__) . 'admin/quiz.php';
    new Amphibee_RH_Questionnaire();

}