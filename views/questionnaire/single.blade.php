@extends('layouts.main')

@section('content')
    <style>

        .step-form__step.active {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .step-form__input {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .step-form__buttons {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 300px;
            margin-top: 20px;
        }

        .step-form__button {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .step-form__submit-btn {
            background-color: #06c;
            color: #fff;
        }

        .step-form__step input.invalid,
        .step-form__step select.invalid,
        .step-form__step textarea.invalid {
            border-color: #ff0000;
        }
    </style>

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
        <form action="{{ url('testlouis') }}" method="post"
              class="w-full h-[50vh] overflow-y-hidden flex items-center justify-center">
            <input type="hidden" name="quiz-name" value="{{ get_post_field('post_name', Loop::id()) }}">
            @csrf
            <div class="flex flex-col items-center">
                @foreach($listing_quiz as $quiz)
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        <div class="step-form__step hidden @if($loop->first) active @endif">
                            <div class="flex flex-col items-center my-5">
                                <h2 class="text-xl text-center mb-5">{{ $quiz['question'] }}</h2>
                                @if($quiz['type_answer'] && $quiz['type_answer'] === 'short_text')
                                    <input type="text" name="{{ $quiz['slug'] }}" class="{{ $class }}" value="{{ old($quiz['slug']) }}" required/>
                                @else
                                    <textarea id="message"
                                              rows="4"
                                              name="{{ $quiz['slug'] }}"
                                              class="{{ $class }}"
                                              placeholder="{{ __('Racontez nous votre histoire...', BEE_RH_TD) }}"
                                              required>{{ old($quiz['slug']) }}</textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-10 flex items-center gap-x-10">
                    <div class="step-form__prev-btn bg-gray-300 hover:bg-gray-400 text-gray-500 hover:text-gray-800 text-sm px-4 py-2 cursor-pointer transition"
                         disabled>Précédent
                    </div>
                    <div class="step-form__next-btn bg-yellowbee-500 text-gray-500 hover:text-gray-800 text-sm px-4 cursor-pointer py-2">
                        Suivant
                    </div>
                    <input type="submit"
                           class="step-form__submit-btn bg-gray-300 text-gray-500 hover:text-white text-sm px-4 py-2 cursor-pointer transition"
                           style="display: none;" value="{{ __('Envoyer', BEE_RH_TD) }}">
                    </input>
                </div>
            </div>
        </form>
    </section>

    <script>
        const prevBtn = document.querySelector('.step-form__prev-btn');
        const nextBtn = document.querySelector('.step-form__next-btn');
        const submitBtn = document.querySelector('.step-form__submit-btn');
        const steps = document.querySelectorAll('.step-form__step');

        let currentStep = 0;

        prevBtn.addEventListener('click', () => {
            if (currentStep > 0) {
                steps[currentStep].classList.remove('active');
                currentStep--;
                steps[currentStep].classList.add('active');
                updateButtons();
            }
        });

        nextBtn.addEventListener('click', () => {
            // Récupère tous les champs de l'étape courante
            const inputs = steps[currentStep].querySelectorAll('input, select, textarea');
            let allInputsValid = true;

            // Vérifie que tous les champs sont valides
            inputs.forEach(input => {
                if (!input.checkValidity() || input.value === '') {
                    allInputsValid = false;
                    input.classList.add('invalid');
                } else {
                    input.classList.remove('invalid');
                }
            });

            // Si tous les champs sont valides, passe à l'étape suivante
            if (allInputsValid) {
                steps[currentStep].classList.remove('active');
                currentStep++;
                steps[currentStep].classList.add('active');
                updateButtons();
            }
        });

        function updateButtons() {
            if (currentStep === 0) {
                prevBtn.disabled = true;
            } else {
                prevBtn.disabled = false;
            }

            if (currentStep === steps.length - 1) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            } else {
                nextBtn.style.display = 'inline-block';
                submitBtn.style.display = 'none';
            }
        }

        updateButtons();
    </script>
@endsection