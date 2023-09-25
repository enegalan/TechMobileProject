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

    


    // Opinion Media Slider
    const left_arrow = document.getElementById('media_slider_controller_previous');
    const right_arrow = document.querySelector('#media_slider_controller_next i');
    
    var media = document.querySelectorAll('.media_container img');
    left_arrow.addEventListener("click", slidePrevious);
    right_arrow.addEventListener("click", slideNext);

    var translate_x_base = -174;

    var translate_x_array = [];
    media.forEach((m, index) =>  {
        translate_x_array.push(index);
    });

    translate_x_array.forEach(translate_x => {
        if(translate_x === 0){
            translate_x_array[0] = 0;
        }else if(translate_x === 1){
            translate_x_base = translate_x_base;
            translate_x_array[1] = translate_x_base;
        }else{
            translate_x_base = translate_x_base * 2
            translate_x_array[translate_x] = translate_x_base;
        }
    });

    function setTranslateX(index){
        var media_container = document.querySelector('.media_container');
        media_container.style.transform = `translateX(${translate_x_array[index]}px)`; 
    }

    //First set the first image as selected
    media[0].setAttribute('aria-selected', true);

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
        console.log("selected: ",selected);
        console.log("media length: ", media)
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

    // Opinion Media Slider Controllers
    const opinion_media_slider_elements = document.querySelectorAll('.opinion_media_slider span');

    // First set first slider controller active by default
    opinion_media_slider_elements[0].setAttribute('aria-selected', true);

    opinion_media_slider_elements.forEach(element => {
        element.addEventListener("click", function() {
            removeAllSliderControllerActive();
            element.setAttribute('aria-selected', true);
            console.log(parseInt(element.getAttribute('value')))
            slideTo(parseInt(element.getAttribute('value')))
            setTranslateX(parseInt(element.getAttribute('value')));
        })
    })

    function removeAllSliderControllerActive() { 
        opinion_media_slider_elements.forEach(slider =>{
            slider.setAttribute('aria-selected', "");
        });
    }
});