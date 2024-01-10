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
/* Submenu link show/hide */
function toggleSubmenu() {
    var submenu = document.querySelector('#submenu');
    submenu.style.transform = (submenu.style.transform === 'translateX(-10vw)') ? 'translateX(100vw)' : 'translateX(-10vw)';
}

function toggleColorScheme() {
    const htmlElement = document.querySelector('html');
    const iconElement = document.querySelector('#darkmode-btn i');

    htmlElement.classList.toggle('dark');
    
    if (iconElement.classList.contains('fa-sun')) {
        iconElement.classList.remove('fa-sun');
        iconElement.classList.add('fa-moon');
    } else {
        iconElement.classList.remove('fa-moon');
        iconElement.classList.add('fa-sun');
    }

    if (htmlElement.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
}
function detectColorScheme () {
    var theme = "light";
    if (!window.matchMedia) {
        return false;
    } else {
        if (window.matchMedia("(prefers-color-scheme: dark)").matches || localStorage.getItem('theme') == "dark") {
            theme = "dark";
        } 
        if (window.matchMedia("(prefers-color-scheme: light)").matches || localStorage.getItem('theme') == 'light') {
            theme = "light";
        }
    } 
        

    if (theme == "dark") {
        !document.querySelector('html').classList.contains('dark') ? document.querySelector('html').classList.add('dark') : '';
    } else {
        document.querySelector('html').classList.contains('dark') ? document.querySelector('html').classList.remove('dark') : '';
    }
}
detectColorScheme();

// Preloading
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        document.getElementById("preload-view").style.display = "none";
    }, 1000);
});
