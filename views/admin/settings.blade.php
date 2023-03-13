@if(request()->hasCookie('errors'))
    <div class="rounded-md bg-red-50 ml-4 mr-8 my-8 p-4 mt-8">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">{{ __('Quelque chose ne va pas : ', BEE_RH_TD) }}</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul role="list" class="list-disc space-y-1 pl-5">
                        @foreach(json_decode(request()->cookie('errors')) as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="bg-white shadow sm:rounded-lg ml-4 mr-8 my-8">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-base font-semibold leading-6 text-gray-900">
            {{ __('Slack Webhook', BEE_RH_TD) }}
        </h3>
        <div class="mt-2 text-sm text-gray-500">
            {!! __("Si vous souhaitez envoyer des messages sur un channel Slack, vous devez disposer d'un 'Webhook URL'.
            Le Webhook URL est une URL unique fournie par Slack qui vous permet de publier des messages sur un channel
            Slack spécifique. Voici comment vous pouvez réclamer : <br />
            Tout d'abord, vous devez vous connecter à Slack en utilisant un compte ayant les autorisations nécessaires
            pour créer des Webhooks.", BEE_RH_TD) !!}

            <ul class="list-decimal pl-7 py-3">
                <li>
                    {!! __('Accédez à la page de configuration des intégrations de Slack', BEE_RH_TD) !!}
                    <a href="https://api.slack.com/apps" class="font-bold text-yellowbee-500">https://api.slack.com/apps</a>
                </li>
                <li>
                    {!! __('Cliquez sur "Créer une application" pour créer une nouvelle application.', BEE_RH_TD) !!}}
                </li>
                <li>
                    {!! __('Donnez un nom à votre application et sélectionnez le workspace Slack sur lequel vous souhaitez envoyer
            des messages.', BEE_RH_TD) !!}}
                </li>
                <li>
                    {!! __("Sélectionnez l'option 'Incoming Webhooks' dans le menu 'Add features and functionality' pour ajouter un
            nouveau Webhook.", BEE_RH_TD) !!}}
                </li>
                <li>
                    {!! __("Cliquez sur \"Activate Incoming Webhooks\" pour activer les Webhooks entrants.", BEE_RH_TD) !!}}
                </li>
                <li>
                    {!! __("Cliquez sur \"Add New Webhook to Workspace\" pour ajouter un nouveau Webhook à votre workspace Slack.", BEE_RH_TD) !!}}
                </li>
                <li>
                    {!! __("Sélectionnez le channel sur lequel vous souhaitez envoyer des messages et cliquez sur \"Authorize\".", BEE_RH_TD) !!}}
                </li>
                <li>
                    {!! __('Sélectionnez le channel sur lequel vous souhaitez envoyer des messages avec ce Webhook.', BEE_RH_TD) !!}}
                </li>
                <li>
                    {!! __("Une fois que le Webhook est créé, Slack vous fournira une URL unique appelée \"Webhook URL\". C'est cette
            URL que vous devez renseigner", BEE_RH_TD) !!}}
                </li>
            </ul>

        </div>
        <form method="post" action="{{ home_url('bee-save/slack-webhook') }}" class="mt-5 sm:flex sm:items-center">
            @csrf
            <div class="w-full sm:max-w-xs">
                <label for="slack_webhook" class="sr-only">Slack URL</label>
                <input type="text" name="slack_webhook" id="slack_webhook"
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellowbee-500 sm:text-sm sm:leading-6"
                       placeholder="https://hooks.slack.com/services/XXXX">
            </div>
            <button type="submit"
                    class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-yellowbee-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellowbee-500 sm:mt-0 sm:ml-3 sm:w-auto">
                {{ __('Sauvegarder', BEE_RH_TD) }}
            </button>
        </form>
    </div>
</div>