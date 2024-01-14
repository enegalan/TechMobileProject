document.addEventListener("DOMContentLoaded", function () {
    // Carrusel smartphones
    var slides = document.getElementsByClassName("sliderBlock_items__itemPhoto");
    var items = document.getElementsByClassName("sliderBlock_positionControls")[0];
    var currentSlideItem = document.getElementsByClassName("sliderBlock_positionControls__paginatorItem");
    var currentSlide = 0;

    // Llamar a goToSlide con el índice actual al cargar la página
    goToSlide(currentSlide);

    /*setInterval(nextSlide, 5000);  /// Tiempo de delay de cada slide

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }*/
    function goToSlide(n) {
        slides[currentSlide].className = 'sliderBlock_items__itemPhoto';
        items.children[currentSlide].className = 'sliderBlock_positionControls__paginatorItem';
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].className = 'sliderBlock_items__itemPhoto sliderBlock_items__showing';
        items.children[currentSlide].className = 'sliderBlock_positionControls__paginatorItem sliderBlock_positionControls__active';
    }

    function goToSlideAfterPushTheMiniBlock() {
        for (var i = 0; i < currentSlideItem.length; i++) {
            currentSlideItem[i].onclick = function (i) {
                var index = Array.prototype.indexOf.call(currentSlideItem, this);
                goToSlide(index);
            }
        }
    }
    goToSlideAfterPushTheMiniBlock();


    /// Especificaciones
    var buttonFullSpecification = document.getElementsByClassName("block_specification")[0];
    var buttonSpecification = document.getElementsByClassName("block_specification__specificationShow")[0];
    var buttonInformation = document.getElementsByClassName("block_specification__informationShow")[0];
    var blockCharacteristic = document.querySelector(".block_descriptionCharacteristic");
    buttonFullSpecification.onclick = function () {
        buttonSpecification.classList.toggle("hide");
        buttonInformation.classList.toggle("hide");
        blockCharacteristic.classList.toggle("block_descriptionCharacteristic__active");
    };


    /// Cantidad para compra
    var up = document.getElementsByClassName('block_quantity__up')[0],
        down = document.getElementsByClassName('block_quantity__down')[0],
        input = document.getElementsByClassName('block_quantity__number')[0];
    function getValue() {
        return parseInt(input.value);
    }
    up.onclick = function (event) {
        input.value = getValue() + 1;
        event.preventDefault();
    };
    down.onclick = function (event) {
        if (input.value <= 1) {
            event.preventDefault();
            return 1;
        } else {
            event.preventDefault();
            input.value = getValue() - 1;
        }
    }


    // Set smartphone rating stars width
    const rating_avg_stars = document.querySelector('#rating_avg_stars');
    const avg_value = parseFloat(rating_avg_stars.getAttribute('value'));
    setRatingStars(rating_avg_stars, avg_value, 5);

    // Set each opinion rating stars width
    const opinion_stars = document.querySelectorAll('.opinion_stars');
    opinion_stars.forEach(opinion_star => {
        const opinion_star_value = parseFloat(opinion_star.getAttribute('value'));
        setRatingStars(opinion_star, opinion_star_value, 5);
    });

    function setRatingStars(element, avg_value, max_value) {
        const max_width = 100; // with max value

        var actual_width = (avg_value / max_value) * max_width;
        actual_width = Math.min(max_width, actual_width);
        element.style.width = actual_width + "%";
    }
    // Set each rating_bar_(5-1) width
    const rating_values = document.querySelectorAll('.ratings_ul .rating_li .rating_value');
    const opinion_total = parseInt(document.querySelector('.opinions_value').getAttribute('value'));

    rating_values.forEach((rating_value, index) => {
        const reversedIndex = 5 - index;
        const value = parseInt(rating_value.innerHTML);
        const rating_bar = document.querySelector('.rating_bar_' + reversedIndex);
        setRatingStars(rating_bar, value, opinion_total);

    })


    // Opinion Media Slider
    const opinionContainers = document.querySelectorAll('.opinion_contenedor');

    opinionContainers.forEach((container, containerIndex) => {
        const opinionId = container.getAttribute('data-id');
        const media = container.querySelectorAll('#op-' + opinionId + ' .media_container img');
        const left_arrow = document.querySelector('#op-' + opinionId + ' #media_slider_controller_previous');
        const right_arrow = document.querySelector('#op-' + opinionId + ' #media_slider_controller_next');
        left_arrow && left_arrow.addEventListener("click", slidePrevious);
        right_arrow && right_arrow.addEventListener("click", slideNext);

        var translate_x_base = -174;
        var translate_x_array = [];

        media.forEach((m, index) => {
            translate_x_array.push(index);
        });

        translate_x_array.forEach(translate_x => {
            if (translate_x === 0) {
                translate_x_array[0] = 0;
            } else if (translate_x === 1) {
                translate_x_base = translate_x_base;
                translate_x_array[1] = translate_x_base;
            } else {
                translate_x_base = translate_x_base * 2;
                translate_x_array[translate_x] = translate_x_base;
            }
        });

        function setTranslateX(index) {
            var media_container = container.querySelector('.media_container');
            media_container.style.transform = `translateX(${translate_x_array[index]}px)`;
        }

        // First set the first image as selected
        if (media.length > 0) {
            media[0].setAttribute('aria-selected', true);
        }

        function slidePrevious() {
            var selected = getSelectedMedia();
            if (selected === 0) {
                slideLast();
            } else {
                slideTo(selected - 1);
                setTranslateX(selected - 1);
            }
        }

        function slideNext() {
            var selected = getSelectedMedia();
            if (selected === media.length - 1) {
                slideFirst();
            } else {
                slideTo(selected + 1);
                setTranslateX(selected + 1);
            }
        }

        function slideTo(n) {
            removeAllSelectedMedia();
            setSelectedMedia(media[n]);
            
            const opinion_media_slider_spans = document.querySelectorAll('#op-' + opinionId + ' .opinion_media_slider span');
            console.log(opinion_media_slider_spans);
            //Set all slider control not active
            opinion_media_slider_spans.forEach((span) => {
                if (span.getAttribute('aria-selected')) {
                    span.setAttribute('aria-selected', false);    
                }
            })
            //Set active the correspondent slider control
            opinion_media_slider_spans[n].setAttribute('aria-selected', true);
        }

        function slideFirst() {
            removeAllSelectedMedia();
            slideTo(0);
            setTranslateX(0);
        }

        function slideLast() {
            removeAllSelectedMedia();
            slideTo(media.length - 1);
            setTranslateX(media.length - 1);
        }

        function setSelectedMedia(mediaElement) {
            mediaElement.setAttribute('aria-selected', true);
        }

        function removeAllSelectedMedia() {
            media.forEach(m => {
                m.setAttribute('aria-selected', '');
            });
        }

        function getSelectedMedia() {
            for (let i = 0; i < media.length; i++) {
                if (media[i].getAttribute('aria-selected')) {
                    return i;
                }
            }
            return -1;
        }

        // Opinion Media Slider Controllers
        const opinionMediaSliderElements = container.querySelectorAll('.opinion_media_slider span');

        // First set the first slider controller active by default
        if (opinionMediaSliderElements.length > 0) {
            opinionMediaSliderElements[0].setAttribute('aria-selected', true);
        }

        opinionMediaSliderElements.forEach((element, elementIndex) => {
            element.addEventListener('click', function () {
                removeAllSliderControllerActive(opinionMediaSliderElements);
                element.setAttribute('aria-selected', true);
                slideTo(elementIndex);
                setTranslateX(elementIndex);
            });
        });

        function removeAllSliderControllerActive(elements) {
            elements.forEach(slider => {
                slider.setAttribute('aria-selected', '');
            });
        }
    });

    // Useful opinion function
    document.querySelectorAll('.useful_opinion_a').forEach(element => {
        element.addEventListener('click', usefulOpinion)
    })
    function usefulOpinion(event) {
        event.preventDefault();
        
        var opinion_id = event.target.getAttribute('data-id');
        const formData = new FormData();
        formData.append('id', opinion_id);

        if (localStorage.getItem('user_id')) {
            fetch('php/add_new_useful_opinion.php', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.text())
            .then(data => {
                window.location.reload();
            })
        }
    }

    // Open an opinion reply
    document.querySelectorAll('.answer_opinion').forEach(element => {
        element.addEventListener("click", showReplyForm);
    })

    function showReplyForm(event) {
        setAllRepliesDisabled();
        document.querySelectorAll('.reply_opinion').forEach(element => {
            if (element.getAttribute('data-id') === event.target.getAttribute('data-id')) {
                element.classList.contains('disabled') && element.classList.remove('disabled')
                !element.classList.contains('active') && element.classList.add('active');
            }
        })
    }

    // Set all opinion replies disabled
    setAllRepliesDisabled();

    function setAllRepliesDisabled() {
        document.querySelectorAll('.reply_opinion').forEach(element => {
            !element.classList.contains('disabled') && element.classList.add('disabled')
            element.classList.contains('active') && element.classList.remove('active');
        });
    }

    document.querySelectorAll('.reply_cancel_button').forEach(element => {
        element.addEventListener('click', setAllRepliesDisabled);
    })

    // Avoid user to erase @username from reply textareas
    document.querySelectorAll('.reply_textarea').forEach(textarea => {
        textarea.addEventListener('input', (event) => {
            if (!event.target.value.startsWith(event.target.placeholder)) {
                event.target.value = event.target.placeholder;
            }
        })
    })

    // Request reply a opinion
    document.querySelectorAll('.reply_button').forEach(button => {
        button.addEventListener('click', async (event) => {
            var opinion_id = event.target.getAttribute('data-id');
            var comment = document.querySelector('.reply_opinion[data-id="' + opinion_id + '"] .reply_textarea').value;
            const formData = new FormData();
            formData.append('opinion_id', opinion_id);
            formData.append('comment', comment);

            if (comment.length >= 15) {
                await fetch('php/reply_opinion.php', {
                    method: 'POST',
                    body: formData,
                }).then(res => res.text())
                .then(data => {
                    window.location.reload();
                })
            }
        });
    });

    // Open opinion answer reply
    document.querySelectorAll('.opinion_answer_reply').forEach(element => {
        element.addEventListener("click", showAnswerReplyForm);
    })

    function showAnswerReplyForm(event) {
        console.log('clickckckckc');
        setAllRepliesDisabled();
        document.querySelectorAll('.reply_answer_opinion').forEach(element => {
            if (element.getAttribute('data-id') === event.target.getAttribute('data-id')) {
                element.classList.contains('disabled') && element.classList.remove('disabled')
                !element.classList.contains('active') && element.classList.add('active');
            }
        })
    }

    // Set all opinion replies disabled
    setAllAnswerRepliesDisabled();

    function setAllAnswerRepliesDisabled() {
        setAllRepliesDisabled();
        document.querySelectorAll('.reply_answer_opinion').forEach(element => {
            !element.classList.contains('disabled') && element.classList.add('disabled')
            element.classList.contains('active') && element.classList.remove('active');
        });
    }

    document.querySelectorAll('.reply_cancel_button').forEach(element => {
        element.addEventListener('click', setAllAnswerRepliesDisabled);
    })

    // Request the opinion answer reply
    document.querySelectorAll('.reply_answer_button').forEach(button => {
        button.addEventListener('click', async (event) => {
            console.log(event.target);
            var opinion_id = event.target.getAttribute('data-id');
            var answer_id = event.target.getAttribute('answer-id');
            var comment = document.querySelector('.reply_answer_opinion[data-id="' + answer_id + '"] .reply_textarea').value;
            const formData = new FormData();
            formData.append('opinion_id', opinion_id);
            formData.append('comment', comment);

            if (comment.length >= 15) {
                await fetch('php/reply_opinion.php', {
                    method: 'POST',
                    body: formData,
                }).then(res => res.text())
                .then(data => {
                    window.location.reload();
                })
            }
        });
    });
});