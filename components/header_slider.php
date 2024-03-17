<?php

$slides = array(
    [
        "min" => "images/banners/es/min/banner1.avif",
        "full" => "images/banners/es/full/banner1.avif",
        "href" => "",
    ],
    [
        "min" => "images/banners/es/min/banner2.avif",
        "full" => "images/banners/es/full/banner2.avif",
        "href" => "",
    ],
    [
        "min" => "images/banners/es/min/banner3.avif",
        "full" => "images/banners/es/full/banner3.avif",
        "href" => "",
    ],
    [
        "min" => "images/banners/es/min/banner4.avif",
        "full" => "images/banners/es/full/banner4.avif",
        "href" => "",
    ]
);

$slidesDom = array();
foreach ($slides as $slide) {
    $slideDom = '
        <div class="swiper-slide">
            <a href="' . $slide['href'] . '">
                <picture>
                    <source media="(max-width: 768px)" srcset="' . $slide['min'] . '">
                    <img src="' . $slide['full'] . '"/>
                </picture>
            </a>
        </div>
    ';
    array_push($slidesDom, $slideDom);
}

echo '
    <div class="sliderContainer container">
        <!-- Slider main container -->
        <div id="header" class="swiper">
            <div class="swiper-wrapper">
                <!-- Slides -->';

foreach ($slidesDom as $slideDom) {
    echo $slideDom;
}

echo '
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </div>
';