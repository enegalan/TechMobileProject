document.addEventListener("DOMContentLoaded", function(){
    // Carrusel
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

    function setRatingStars(element, avg_value, max_value){
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

    
    const all_opinions = document.querySelectorAll('.opinion_contenedor');
    all_opinions.forEach(opinion =>{
        console.log(opinion.getAttribute('data-id'))
        initializeOpinionMediaSlider(opinion.getAttribute('data-id'))
    })


    function initializeOpinionMediaSlider(opinionId) {
        const opinionContainer = document.querySelector(`#opinion_media_${opinionId}`);
        const mediaContainer = opinionContainer.querySelector(`#media_container_${opinionId}`);
        const leftArrow = opinionContainer.querySelector(`#media_slider_controller_${opinionId} #media_slider_controller_previous`);
        const rightArrow = opinionContainer.querySelector(`#media_slider_controller_${opinionId} #media_slider_controller_next`);
        const media = mediaContainer.querySelectorAll('img');
        const sliderElements = opinionContainer.querySelectorAll(`#opinion_media_slider_${opinionId} span`);
    
        let translateXBase = -174;
        let translateXArray = [];
    
        media.forEach((m, index) => {
            translateXArray.push(index);
        });
    
        translateXArray.forEach(translateX => {
            if (translateX === 0) {
                translateXArray[0] = 0;
            } else if (translateX === 1) {
                translateXBase = translateXBase;
                translateXArray[1] = translateXBase;
            } else {
                translateXBase = translateXBase * 2;
                translateXArray[translateX] = translateXBase;
            }
        });
    
        leftArrow.addEventListener("click", slidePrevious);
        rightArrow.addEventListener("click", slideNext);
    
        sliderElements.forEach((element, index) => {
            element.addEventListener("click", () => {
                removeAllSliderControllerActive();
                element.setAttribute('aria-selected', true);
                slideTo(index);
                setTranslateX(index);
            });
        });

        function setSliderElementActive(n){
            sliderElements.forEach((element, index) =>{
                if (n === index + 1){
                    element.setAttribute('aria-selected', true);
                }
            });
        }
    
        function setTranslateX(index) {
            mediaContainer.style.transform = `translateX(${translateXArray[index]}px)`;
        }
    
        function slidePrevious() {
            const selected = getSelectedMedia();
            if (selected === 0) {
                slideLast();
            } else {
                slideTo(selected - 1);
                setTranslateX(selected - 1);
            }
        }
    
        function slideNext() {
            const selected = getSelectedMedia();
            if (selected === media.length - 1) {
                slideFirst();
            } else {
                slideTo(selected + 1);
                setTranslateX(selected + 1);
                setSliderElementActive(selected + 1);
            }
        }
    
        function slideTo(n) {
            removeAllSelectedMedia();
            setSelectedMedia(media[n]);
            setSliderElementActive(n);
        }
    
        function slideFirst() {
            removeAllSelectedMedia();
            slideTo(0);
            setTranslateX(0);
            setSliderElementActive(0);
        }
    
        function slideLast() {
            removeAllSelectedMedia();
            slideTo(media.length - 1);
            setTranslateX(media.length - 1);
            setSliderElementActive(media.length - 1);
        }
    
        function setSelectedMedia(mediaElement) {
            mediaElement.setAttribute('aria-selected', true);
        }
    
        function removeAllSelectedMedia() {
            media.forEach(m => {
                m.setAttribute('aria-selected', "");
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
    
        function removeAllSliderControllerActive() {
            sliderElements.forEach(slider => {
                slider.setAttribute('aria-selected', "");
            });
        }
    
        // Inicialmente, establecemos la primera imagen como seleccionada
        media[0].setAttribute('aria-selected', true);
    }    
});