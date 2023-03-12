@extends('layouts.main')

@section('content')
    @php
        $class = "block p-2.5 w-full
                text-sm text-gray-900 bg-gray-50 rounded-lg
                border border-gray-300 focus:ring-yellowbee-500 focus:border-yellowbee-500
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellowbee-500 dark:focus:border-yellowbee-500";

    @endphp

    <section class="lg:mt-20 h-[50vh] flex flex-col items-center justify-center">
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-yellow-100 py-5 px-6 text-base text-yellow-800">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li class="{{ !$loop->last ? 'pb-2' : '' }}">{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('testlouis') }}/{{ get_the_ID() }}" method="post"
              class="w-full h-[50vh] overflow-y-hidden flex items-center justify-center">
            <input type="hidden" name="quiz-name" value="{{ Loop::title() }}">
            @csrf
            <div class="flex flex-col items-center">
                @foreach($listing_quiz as $quiz)
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        <div class="step-form__step hidden @if($loop->first) active @endif">
                            <div class="flex flex-col items-center my-5">
                                <h2 class="text-xl text-center mb-5">{{ $quiz['question'] }}</h2>
                                @if($quiz['type_answer'] && $quiz['type_answer'] === 'short_text')
                                    <input type="text" name="{{ $quiz['slug'] }}" class="{{ $class }}" value="{{ old($quiz['slug']) }}" required/>
                                @elseif($quiz['type_answer'] && $quiz['type_answer'] === 'long_text')
                                    <textarea id="message"
                                              rows="4"
                                              name="{{ $quiz['slug'] }}"
                                              class="{{ $class }}"
                                              placeholder="{{ __('Racontez nous votre histoire...', BEE_RH_TD) }}"
                                              required>{{ old($quiz['slug']) }}</textarea>
                                @elseif($quiz['type_answer'] && $quiz['type_answer'] === 'one_select' && !empty($quiz['possible_answer']))
                                    <div class="flex flex-wrap justify-center gap-4 max-w-3xl">
                                        @foreach($quiz['possible_answer'] as $answer)
                                            @php($slug = Illuminate\Support\Str::slug($quiz['question']))
                                            <label
                                                    x-data="{ check: false }"
                                                    @click="check = !check"
                                                    for="{{ $slug . "_" .$answer['answer']['value'] }}"
                                                    class="text-center transition duration-500 bg-orange-200/25 hover:bg-orange-200/50 hover:ring-2 hover:ring-orange-200 px-4 py-2 rounded-md text-sm hover:cursor-pointer"
                                                    :class="{ 'bg-orange-300 hover:bg-orange-400/75': check }"
                                            >
                                                {{ $answer['answer']['label'] }}
                                                {{ $answer['pictogramme'] }}
                                            </label>
                                            <input class="hidden" type="radio" id="{{ $slug . "_" .$answer['answer']['value'] }}" name="quiz_possible_answer_{{ Illuminate\Support\Str::slug($quiz['question']) }}[]" value="{{ $answer['answer']['value'] }}">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-10 flex items-center gap-x-10">
                    <div class="step-form__prev-btn bg-gray-300 hover:bg-gray-400 text-gray-500 hover:text-gray-800 text-sm px-4 py-2 cursor-pointer transition"
                         disabled>{{ __('Précédent', BEE_RH_TD) }}
                    </div>
                    <div class="step-form__next-btn bg-yellowbee-500 text-gray-500 hover:text-gray-800 text-sm px-4 cursor-pointer py-2">
                        {{ __('Suivant', BEE_RH_TD) }}
                    </div>
                    <input type="submit"
                           class="step-form__submit-btn text-gray-500 hover:text-white text-sm px-4 py-2 cursor-pointer transition"
                           style="display: none;" value="{{ __('Envoyer', BEE_RH_TD) }}">
                </div>
            </div>
        </form>
    </section>
@endsection