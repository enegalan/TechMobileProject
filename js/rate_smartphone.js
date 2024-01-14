const rate_controllers = document.querySelector('.rate_controllers');
const rate_next_button = document.querySelector('.rate_next_button');
const rate_previous_button = document.querySelector('.rate_previous_button');
const rate_finish_button = document.querySelector('.rate_finish_button');

const steps = [
    document.querySelector('#rate_general'),
    document.querySelector('#opinion'),
    document.querySelector('#images'),
];

const stepsValidations = [
    {
        selector: steps[0],
        validation: () => {
            return document.querySelector('.block_rating__stars input[name="rating"]:checked') ? true : false;
        },
        error: () => {
            toast.push({
                title: 'General rating is required',
                style: 'error',
                dismissAfter: '3s'
            });
        }
    },
    {
        selector: steps[0],
        validation: () => {
            return document.querySelector('input[name="recommended"]:checked') ? true : false;
        },
        error: () => {
            toast.push({
                title: 'Recommended field is required',
                style: 'error',
                dismissAfter: '3s'
            });
        }
    },
    {
        selector: steps[1],
        validation: () => {
            return document.querySelector('textarea[name="opinion"]').value != '' ? true : false;
        },
        error: () => {
            toast.push({
                title: 'Opinion is required',
                style: 'error',
                dismissAfter: '3s'
            });
        }
    },
];

document.querySelectorAll('.rate_step').forEach(step => {
    step.addEventListener('click', (event) => {
        if (step.querySelector('.done') && event.target.tagName.toLowerCase() == "svg") {
            setAllStepsNone();

            var data_id = event.target.getAttribute('data-id') || 1;
            svgToSpan(document.querySelector('#step' + data_id + ' .done'), data_id);

            document.querySelector('#step' + data_id + ' .done').classList.add("active");
            document.querySelector('#step' + data_id + ' .done').classList.remove("done");

            // Remove all active classes next to data_id element
            document.querySelectorAll('.active').forEach(step => {
                if (step.getAttribute('data-id') > data_id) {
                    step.classList.remove('active');
                }
            })

            // Remove all done classes next to data_id element
            document.querySelectorAll('.done').forEach(step => {
                if (step.getAttribute('data-id') > data_id) {
                    svgToSpan(step, step.getAttribute('data-id'));
                    step.classList.remove('done');
                }
            })

            steps[data_id - 1].style.display = 'block';
            if (data_id == 1) {
                rate_previous_button.style.display = 'none';
            }
            rate_finish_button.style.display = 'none';
            rate_next_button.style.display = 'block';

            rate_next_button.value = parseInt(data_id);
            rate_previous_button.value = parseInt(data_id) - 1;
        }
    });
});

function svgToSpan(svgEl, data) {
    svgEl.innerHTML = `<span class="rate_step_block_number_span active">${data}</span>`;
}

function setAllStepsNone() {
    steps.forEach(step => {
        step.style.display = 'none';
    });
}

rate_next_button.addEventListener('click', (event) => {
    var previousStep = parseInt(event.target.value) > 0 ? steps[parseInt(event.target.value - 1)] : 0;
    var step = steps[parseInt(event.target.value)];

    // Validations
    var validated = true;
    for (var stepValidation of stepsValidations) {
        const { selector, validation, error } = stepValidation;

        if (selector == previousStep) {
            validated = validation();
            if (!validated) {
                error();
            }
        }
    }

    if (validated) {
        // Set all steps not displayed
        setAllStepsNone()

        previousStep.style.display = 'none';
        step.style.display = 'block';
        if (document.querySelector('#step' + parseInt(event.target.value) + " .active")) {
            const prevDoneStep = document.querySelector('#step' + parseInt(event.target.value) + " .active");
            svgToSpan(prevDoneStep, event.target.value);
            prevDoneStep.classList.remove('active');
            prevDoneStep.classList.add('done');
        }

        rate_previous_button.value++;
        rate_next_button.value++;
        if (parseInt(rate_next_button.value) < steps.length) {
            if (rate_previous_button.value > 0) {
                rate_previous_button.style.display = 'block';
            }
        } else {
            rate_next_button.style.display = 'none';
            rate_previous_button.style.display = 'block';
            // Display finish button
            rate_finish_button.style.display = 'block';
        }
        setActiveStepDone()
    }
    
});

rate_previous_button.addEventListener('click', (event) => {
    // Set all steps not displayed
    setAllStepsNone()

    var previousStep = steps[parseInt(event.target.value)];
    var step = steps[parseInt(event.target.value - 1)];

    rate_finish_button.style.display = 'none';
    previousStep.style.display = 'none';
    step.style.display = 'block';

    if (document.querySelector('#step' + parseInt(event.target.value) + " .done")) {
        const prevDoneStep = document.querySelector('#step' + parseInt(event.target.value) + " .done");
        svgToSpan(prevDoneStep, event.target.value);
        prevDoneStep.classList.remove('done');
        prevDoneStep.classList.add('active');
    }

    // Remove all active classes next to data_id element
    document.querySelectorAll('.active').forEach(step => {
        if (step.getAttribute('data-id') > event.target.value) {
            step.classList.remove('active');
        }
    })
    rate_next_button.value--;
    rate_previous_button.value--;

    if (rate_previous_button.value < 1) {
        rate_previous_button.style.display = 'none';
        rate_next_button.style.display = 'block';
    } else {
        rate_next_button.style.display = 'block';
        rate_previous_button.style.display = 'block';
    }
});
rate_finish_button.addEventListener('click', async (event) => {
    // Get all rating information
    var ratings = {};

    var general_rating = document.querySelector('.block_rating__stars > input:checked').value;
    var recommended = document.querySelector('input[name="recommended"]').value;
    var opinion = document.querySelector('textarea[name="opinion"]').value;
    var advantages = document.querySelector('textarea[name="advantages"]').value;
    var disadvantages = document.querySelector('textarea[name="disadvantages"]').value;
    var filesInput = document.querySelector('input[name="files[]"]');
    var files = filesInput.files;

    ratings['smartphone_id'] = document.querySelector('#rateSmartphoneContent').getAttribute('data-product-id');
    ratings['media'] = general_rating;
    ratings['recommended'] = recommended;
    ratings['opinion'] = opinion;
    ratings['advantages'] = advantages;
    ratings['disadvantages'] = disadvantages;

    const formData = new FormData();
    formData.append('ratings', JSON.stringify(ratings));

    // Loop through files and append them individually
    for (let i = 0; i < files.length; i++) {
        formData.append('files[]', files[i]);
    }
    await fetch('php/add_new_opinion.php', {
        method: 'POST',
        body: formData
    }).then(res => res.text())
    .then(data => {
        window.location.href = document.querySelector('#smartphone-href').href;
    });

});

// First render
// Set all steps not displayed
setAllStepsNone();
// Display first step
steps[0].style.display = 'block';
rate_previous_button.style.display = 'none';
rate_finish_button.style.display = 'none';
rate_previous_button.value = 0;
rate_next_button.value = 1;

function setActiveStepDone() {
    const rateNextButton = document.querySelector('.rate_next_button');
    const activeStep = document.querySelector('#step' + (parseInt(rateNextButton.value)) + " .rate_step_block_number");
    const prevStep = document.querySelector('#step' + (parseInt(rateNextButton.value) - 1) + " .rate_step_block_number");
    if (prevStep) {
        prevStep.innerHTML = `
                <svg data-id="${document.querySelector('.rate_previous_button').value}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24" fill="white" data-testid="icon" class="sc-dcJsrY fYhzFh">
                    <path d="M8.8 15.9l-4.2-4.2-1.4 1.4 5.6 5.6 12-12-1.4-1.4L8.8 15.9z"></path>
                </svg>
            `;
        activeStep.classList.remove('active');
        activeStep.classList.add('done')

        // Set next active step
        if (activeStep) {
            activeStep.classList.remove('done');
            activeStep.classList.add('active');
        }
    }
}



