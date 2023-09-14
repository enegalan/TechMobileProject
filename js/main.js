//Navegador minimizado
$(document).ready(function () {
    var altura = $('.right').offset().top;
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > altura) {
            $('.right').addClass('menu-min');
        }
        else {
            $('.right').removeClass('menu-min');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Obtener la URL actual
    var url = window.location.href;
    var index = url.includes("index.php") || url === window.location.origin + "/TechMobileProject/";
    var catalogo = url.includes("catalogo.php");
    var smartphone = url.includes("smartphone.php");
    var manufacturer = url.includes("manufacturer.php");
    var contacto = url.includes("contacto.php");
    var faqs = url.includes("faqs.php");
    var profile = url.includes("profile.php");
    var link1;
    if (index) {
        var link1 = document.querySelector('.nav.right .menu-default[href="index.php"]');
        link1.classList.add('active');
        var link2 = document.querySelector('.nav.right .menu-icons[href="index.php"]');
        link2.classList.add('active');
    } else if (catalogo || smartphone || manufacturer) {
        var link1 = document.querySelector('.nav.right .menu-default[href="catalogo.php"]');
        link1.classList.add('active');
        var link2 = document.querySelector('.nav.right .menu-icons[href="catalogo.php"]');
        link2.classList.add('active');
        if(catalogo || manufacturer){
            //Esqueleto img Producto en Catálogo
            $(document).ready(function () {
                $(".loading").css('visibility', 'hidden');
                $(".esqueleto").delay("300").fadeIn("1000");
                $(".esqueleto").delay("200").fadeOut("100");
                $(".loading").delay("1000").addClass("loaded2").css('visibility', 'visible');
            });
            var imgs = document.getElementsByClassName('loading');
            let esqueleto = imgs.nextElementSibling;
            for (i in imgs) {
                imgs[i].onload = function () {
                    this.className = 'loaded';
                    esqueleto = this.nextElementSibling;
                    esqueleto.className = 'deleted';
                }
            }
        }
        if(smartphone){
            //Rating system
            var starsInput = document.querySelectorAll('.block_rating__stars input');
            var ratingElements = document.getElementsByClassName("block_rating__stars");

            // Supongamos que deseas obtener el atributo smartphone-id del primer elemento
            var firstRatingElement = ratingElements[0];
            var smartphone_id = firstRatingElement.getAttribute("smartphone-id");
            starsInput.forEach(function (starInput) {
                starInput.addEventListener('click', async function () { 
                    var rating = this.value;
                    console.log("RATING: ",rating)
                    console.log("SmartphoneID: ",smartphone_id)
                    var formData = new FormData();
                    formData.append('rating', rating);
                    formData.append('smartphone_id', smartphone_id);
                    await fetch('./php/rating.php',{
                        method: "POST",
                        body: formData
                    }).then(res => res.text())
                    .then(data => {
                        console.log(data);
                    })
                })
            })
        }
    } else if (contacto) {
        var link1 = document.querySelector('.nav.right .menu-default[href="contacto.php"]');
        link1.classList.add('active');
        var link2 = document.querySelector('.nav.right .menu-icons[href="contacto.php"]');
        link2.classList.add('active');

        //Contact Form
        (function ($) {
            "use strict";
            /*[ Validamos información ]*/
            var name = $('.validate-input input[name="name"]');
            var email = $('.validate-input input[name="email"]');
            var subject = $('.validate-input input[name="subject"]');
            var message = $('.validate-input textarea[name="message"]');
            $('.validate-form').on('submit', function () {
                var check = true;
                if ($(name).val().trim() == '') {
                    showValidate(name);
                    check = false;
                }
                if ($(subject).val().trim() == '') {
                    showValidate(subject);
                    check = false;
                }
                if ($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                    showValidate(email);
                    check = false;
                }
                if ($(message).val().trim() == '') {
                    showValidate(message);
                    check = false;
                }
                return check;
            });
            $('.validate-form .input1').each(function () {
                $(this).focus(function () {
                    hideValidate(this);
                });
            });
            function showValidate(input) {
                var thisAlert = $(input).parent();
                $(thisAlert).addClass('alert-validate');
            }
            function hideValidate(input) {
                var thisAlert = $(input).parent();
                $(thisAlert).removeClass('alert-validate');
            }
        });
    } else if (faqs) {
        var link1 = document.querySelector('.nav.right .menu-default[href="faqs.php"]');
        link1.classList.add('active');
        var link2 = document.querySelector('.nav.right .menu-icons[href="faqs.php"]');
        link2.classList.add('active');
    } else if (profile) {
        var link1 = document.querySelector('.nav.right .user-link');
        link1.classList.add('active');
    }
});
