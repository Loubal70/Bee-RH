<?php

namespace Themosis\BeeRH\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaveGlobalInformationController extends Controller
{
    public function store_slack_webhook(Request $request)
    {
        $champs = $request->all();

        // Validation des champs avec l'objet Validator
        $validator = Validator::make($champs, [
            'slack_webhook' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withCookie(cookie('errors', collect($validator->errors()->all())->toJson(), 0.33))
                ->withInput();
        } else {
            $webhook_url = $champs['slack_webhook'];
            $redirect_url = get_admin_url() . 'options-general.php?page=amphibee-rh';

            update_option('bee-rh-slack', $webhook_url);
            return redirect($redirect_url)
                ->withCookie(cookie('success', __('Votre lien Slack a bien été mis à jour !'), 0.33));
        }
    }
}