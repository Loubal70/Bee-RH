<?php

namespace Themosis\BeeRH\PostTypes;

use Action;
use Illuminate\Support\ServiceProvider;
use Themosis\Support\Facades\PostType;
use WordPlate\Acf\ConditionalLogic;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Select;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\TrueFalse;
use WordPlate\Acf\Location;

class Questionnaire extends ServiceProvider
{
    public function register()
    {
        /**
         * Register Post Type
         */
        Action::add('init', [$this, 'register_offer']);
        Action::add('acf/init', [$this, 'register_quiz_fields']);
    }

    public static function register_offer()
    {
        PostType::make('questionnaire', 'Questionnaires', 'Questionnaire')
            ->setLabels([
                'name'               => __('Questionnaires', BEE_RH_TD),
                'singular_name'      => __('Questionnaire', BEE_RH_TD),
                'add_new'            => __('Ajouter un questionnaire', BEE_RH_TD),
                'add_new_item'       => __('Ajouter un nouveau questionnaire', BEE_RH_TD),
                'all_items'          => __('Tous les questionnaires', BEE_RH_TD),
                'edit_item'          => __('Modifier un questionnaire', BEE_RH_TD),
                'new_item'           => __('Nouveau questionnaire', BEE_RH_TD),
                'view_item'          => __('Voir le questionnaire', BEE_RH_TD),
                'search_items'       => __('Rechercher des questionnaires', BEE_RH_TD),
                'not_found'          => __('Aucun questionnaire trouvé', BEE_RH_TD),
                'not_found_in_trash' => __('Aucun questionnaire trouvé dans la corbeille', BEE_RH_TD)
            ])
            ->setArguments([
                'public'              => true,
                'has_archive'         => false,
                'capabilities' => array(
                    'edit_post'          => 'update_core',
                    'read_post'          => 'update_core',
                    'delete_post'        => 'update_core',
                    'edit_posts'         => 'update_core',
                    'edit_others_posts'  => 'update_core',
                    'delete_posts'       => 'update_core',
                    'publish_posts'      => 'update_core',
                    'read_private_posts' => 'update_core'
                ),
                'menu_position'       => 10,
                'menu_icon'           => 'dashicons-feedback',
                'supports'            => array( 'title', 'custom-fields' ),
                'show_in_rest'        => false,
                'rewrite'             => array( 'slug' => 'rh-questionnaire' )
            ])
            ->set();
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
                                ->wrapper(['width' => '40%'])
                                ->required(),
                            Select::make(__('Type de réponse', 'amphibee-rh'), 'type_answer')
                                ->choices([
                                    'short_text' => 'Réponse courte textuelle',
                                    'long_text' => 'Réponse longue textuelle',
                                    'one_select' => 'Case à cocher',
                                ])
                                ->wrapper(['width' => '20%'])
                                ->required(),
                            Repeater::make(__('Réponses possibles', 'amphibee-rh'), 'possible_answer')
                                ->fields([
                                    Select::make(__('Pictogramme', 'amphibee-rh'), 'pictogramme')
                                        ->choices([
                                            'exploding_head' => '🤯',
                                            'light_bulb' => '💡',
                                            'boom' => '💥',
                                            'ok_hand' => '👌',
                                            'pinched_fingers' => '🤌',
                                            'brain' => '🧠',
                                            'eyes' => '👀',
                                        ])
                                        ->wrapper(['width' => '10%'])
                                        ->returnFormat('label')
                                        ->required(),
                                    Select::make(__('Réponse', 'amphibee-rh'), 'answer')
                                        ->choices([
                                            '0-frustrante' => __('Frustrante', 'amphibee-rh'),
                                            '100-inspirantes' => __('Inspirantes', 'amphibee-rh'),
                                            '0-stressantes' => __('Stressantes', 'amphibee-rh'),
                                            '30-tres_chargees' => __('Très chargées', 'amphibee-rh'),
                                            '50-ok' => __('Ok', 'amphibee-rh'),
                                            '100-stimulantes' => __('Stimulantes', 'amphibee-rh'),
                                            '80-super' => __('Super', 'amphibee-rh'),
                                        ])
                                        ->wrapper(['width' => '90%'])
                                        ->returnFormat('array')
                                        ->required(),

                                ])
                                ->wrapper(['width' => '40%'])
                                ->conditionalLogic([
                                    ConditionalLogic::if('type_answer')->equals('one_select')
                                ]),
                        ])
                        ->layout('row')
                ],
                'layout' => 'row',
                'location' => [
                    Location::if('post_type', '==', 'questionnaire'),
                ],
            ]);
        }
    }
}
