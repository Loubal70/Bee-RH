<?php

namespace Themosis\BeeRH\Composers;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;

class QuizzSingle extends Composer
{
    public function compose($view)
    {
        $view->with('listing_quiz', $this->getQuiz());
    }

    /**
     * Generate a slug for all questions
     * @return mixed
     */
    public static function getQuiz()
    {
        $quiz = get_field('listing_quiz' );
        foreach ($quiz as &$question) {
            $question["slug"] = "quiz_" . Str::slug($question["question"], '-');

        }

        return $quiz;
    }
}