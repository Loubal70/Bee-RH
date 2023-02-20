<?php

namespace Themosis\BeeRH\Composers;
use Illuminate\Support\Composer;
use WP_User_Query;

class AdminSingle extends Composer
{
    public function compose($view)
    {
        $view->with('employes', $this->getEmployees());
    }

    public function getEmployees(): array
    {
        $args = array(
            'role' => 'employees',
            'orderby' => 'user_nicename',
            'order' => 'ASC'
        );

        $users_query = new WP_User_Query($args);

        return $users_query->get_results();
    }
}