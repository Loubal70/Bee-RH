<div class="text-center bg-gray-900 py-2.5 px-6 sm:px-3.5 -ml-5">
    <p class="text-sm leading-6 text-white">
        <a href="#"><strong class="font-semibold">{{ __('v-1.0.1 Bêta', BEE_RH_TD) }}</strong>
            <svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>
            {{ __('Découvrez dès à présent les statiques de vos employés depuis votre espace RH', BEE_RH_TD) }}
        </a>
    </p>
</div>

@if(request()->hasCookie('success'))
    <div class="rounded-md bg-green-50 ml-4 mr-8 my-8 p-4 mt-8">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ request()->cookie('success') }}</p>
            </div>
        </div>
    </div>
@endif

<div class="ml-4 mr-8 my-8">
    <h2 class="font-display font-bold text-2xl text-blue">
        {{ __('Espace Ressources Humaines', BEE_RH_TD) }}
    </h2>

    <div class="mt-5 bg-gray-200 p-4">
        <h3 class="text-xl font-bold">
            {{ __('Informations', BEE_RH_TD) }}
        </h3>
        <div class="mt-4 text-base">
            {{ __('Le plugin est en cours de conception, si vous constatez des problèmes, merci de contacter Louis BOULANGER à cette adresse :', BEE_RH_TD) }}
            <a href="mailto:lboulanger@amphibee.fr" class="underline text-sky-600 font-medium">
                lboulanger@amphibee.fr
            </a>
        </div>
    </div>

    <div class="flex justify-between mt-10 border border-solid border-grey-500 divide-x divide-solid divide-grey-500">
        <div class="p-4 basis-2/4">
            <h3 class="font-display font-bold text-xl text-blue"> {{ __('Gestion des équipes', BEE_RH_TD) }} </h3>
        </div>
        <div class="p-4 basis-2/4">
            <h3 class="font-display font-bold text-xl text-blue">
                {{ __('Gestion des employés', BEE_RH_TD) }}
                <span class="text-sm font-light">{{ __('(Utilisateurs ayant le rôle employés)', BEE_RH_TD) }}</span>
            </h3>
            <ul class="mt-5 list-disc pl-7">
                @foreach($employees as $employee)
                    <li>
                        <a href="{!! $employee->data->stats_link !!}">
                            {{ $employee->data->display_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>