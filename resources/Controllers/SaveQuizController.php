<?php

namespace Themosis\BeeRH\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SaveQuizController extends Controller
{
    public function store(Request $request, $id)
    {
        $champs = $request->all();

        // Règles de validation pour les champs dynamiques
        $rules = [];
        $customMessages = [];

        foreach ($champs as $name => $value) {
            if (strpos($name, 'quiz_') === 0) {
                if(Str::startsWith($name, 'quiz_possible_')){
                    $rules[$name] = 'required|array';
                } else{
                    $rules[$name] = 'required|string|max:255';
                }

                $show_name = Str::of($name)
                    ->after('quiz_')
                    ->replace('-', ' ')
                    ->ucfirst()
                    ->finish(' ?');
                $customMessages[$name . '.required'] = __('Le champ ', BEE_RH_TD) . '<strong>' . $show_name . '</strong>' . __(" n'a pas été correctement remplis.", BEE_RH_TD);
            }
        }

        // Validation des champs avec l'objet Validator
        $validator = Validator::make($champs, $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            checkDatabase();
            // Traitement des données
            $collection = new Collection($champs);
            $data = $collection->filter(fn ($value, $key) => strpos($key, 'quiz_') === 0);
            dd($data->toJson());

//            DB::table('rh_questionnaires')->insert([
//                'user_id' => get_current_user_id(),
//                'results' => $data->toJson(),
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);

            // Redirection vers une page de confirmation
//            return redirect()->back();
        }
    }
}