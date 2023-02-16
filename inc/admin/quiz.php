<?php

class Amphibee_RH_Questionnaire {
    public function __construct() {
        register_post_type( 'questionnaire', $this->post_type_args() );
    }

    /**
     * @return array
     */
    public static function post_type_args(): array
    {
        $labels = array(
            'name'               => __('Questionnaires', 'amphibee-rh'),
            'singular_name'      => __('Questionnaire', 'amphibee-rh'),
            'add_new'            => __('Ajouter un questionnaire', 'amphibee-rh'),
            'add_new_item'       => __('Ajouter un nouveau questionnaire', 'amphibee-rh'),
            'edit_item'          => __('Modifier un questionnaire', 'amphibee-rh'),
            'new_item'           => __('Nouveau questionnaire', 'amphibee-rh'),
            'view_item'          => __('Voir le questionnaire', 'amphibee-rh'),
            'search_items'       => __('Rechercher des questionnaires', 'amphibee-rh'),
            'not_found'          => __('Aucun questionnaire trouvé', 'amphibee-rh'),
            'not_found_in_trash' => __('Aucun questionnaire trouvé dans la corbeille', 'amphibee-rh')
        );

        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'has_archive'         => true,
            'menu_position'       => 10,
            'menu_icon'           => 'dashicons-feedback',
            'supports'            => array( 'title', 'custom-fields' ),
            'show_in_rest'        => false,
            'rewrite'             => array( 'slug' => 'questionnaire' )
        );

        return $args;
    }

    public function disable_seo_analysis( ): array
    {
        global $post_types;
        $post_types[] = 'questionnaire';
        return $post_types;
    }
}