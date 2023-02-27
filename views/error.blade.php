<div class="grid min-h-full place-items-center bg-white py-24 px-6 sm:py-32 lg:px-8 ml-4 mr-8 my-8">
    <div class="text-center">
        <p class="text-base font-semibold text-yellowbee-500">{{ __('Erreur SQL', BEE_RH_TD) }}</p>
        <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ __('Une erreur est survenue', BEE_RH_TD) }}</h1>
        <p class="mt-6 text-base leading-7 text-gray-500">{{ $error }}</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ admin_url('admin.php?page=amphibee-rh') }}" class="rounded-md bg-yellowbee-500 px-3.5 py-2.5 text-sm font-semibold shadow-sm">
                {{ __('Retourner en arrière') }}
            </a>
            <a href="mailto:lboulanger@amphibee.fr" class="text-sm font-semibold text-gray-900">{{ 'Contactez le support', BEE_RH_TD }} <span aria-hidden="true">&rarr;</span></a>
        </div>
    </div>
</div>