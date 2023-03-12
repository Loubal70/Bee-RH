const prevBtn = document.querySelector('.step-form__prev-btn');
const nextBtn = document.querySelector('.step-form__next-btn');
const submitBtn = document.querySelector('.step-form__submit-btn');
const steps = document.querySelectorAll('.step-form__step');

let currentStep = 0;

if(prevBtn){
    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            steps[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
            updateButtons();
        }
    });
}

if(nextBtn){
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
}

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

if(prevBtn && nextBtn && submitBtn){
    updateButtons();
}