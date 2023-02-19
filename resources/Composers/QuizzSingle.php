<?php

namespace Themosis\BeeRH\Composers;
use Illuminate\Support\Composer;

class QuizzSingle extends Composer
{
    public function compose($view)
    {
        $view->with('listing_quiz', get_field('listing_quiz', ));
    }
}