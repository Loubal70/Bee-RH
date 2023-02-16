<?php

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Select;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Location;

class Amphibee_RH_Questionnaire {
    public function __construct() {
        register_post_type( 'questionnaire', $this->post_type_args() );
        Action::add('acf/init', $this->register_quiz_fields());
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

    public static function register_quiz_fields()
    {
        if (function_exists(('register_extended_field_group')) && function_exists('register_field_group') ) {
            register_extended_field_group([
                'title' => 'Questionnaire RH',
                'fields' => [
                    Repeater::make(__('Listes des questions', 'amphibee-rh'), 'listing_quiz')
                        ->fields([
                            Text::make(__('Question', 'amphibee-rh'), 'question')
                                ->wrapper(['width' => '40%']),
                            Select::make(__('Type de réponse', 'amphibee-rh'), 'type_answer')
                                ->choices([
                                    'short_text' => 'Réponse courte textuelle',
                                    'long_text' => 'Réponse longue textuelle'
                                ])
                                ->wrapper(['width' => '20%'])
                                ->required(),
                        ])
                ],
                'layout' => 'block',
                'location' => [
                    Location::if('post_type', '==', 'questionnaire'),
                ],
            ]);
        }
    }
}