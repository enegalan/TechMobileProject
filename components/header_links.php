<?php

include 'lang/detect_lang.php';

echo '
    <a href="index.php" class="nav-link menu-default">
        <span class="nav-link-span">
            <span class="u-nav">
            ' . $lang['home'] . '
            </span>
        </span>
    </a>
    <a href="catalogo.php" class="nav-link menu-default">
        <span class="nav-link-span">
            <span class="u-nav">
            ' . $lang['catalogue'] . '
            </span>
        </span>
    </a>
    <a href="contacto.php" class="nav-link menu-default">
        <span class="nav-link-span">
            <span class="u-nav">
            ' . $lang['contact'] . '
            </span>
        </span>
    </a>
    <a href="faqs.php" class="nav-link menu-default">
        <span class="nav-link-span">
            <span class="u-nav">
            FAQs
            </span>
        </span>
    </a>
    <!--ICON LINKS-->
    <a href="index.php" class="nav-link menu-icons">
        <span class="nav-link-span">
            <span class="fa-solid fa-house fa-lg">
            </span>
        </span>
    </a>
    <a href="catalogo.php" class="nav-link menu-icons">
        <span class="nav-link-span">
            <span class="fa-solid fa-bag-shopping fa-lg">
            </span>
        </span>
    </a>
    <a href="contacto.php" class="nav-link menu-icons">
        <span class="nav-link-span">
            <span class="fa-solid fa-envelope fa-lg">
            </span>
        </span>
    </a>
    <a href="faqs.php" class="nav-link menu-icons">
        <span class="nav-link-span">
            <span class="fa-solid fa-circle-question fa-lg">
            </span>
        </span>
    </a>
    <!--Dropdown Origin-->	
    <a href="#" class="c-dropdown__origin nav-link userDropdown js-dropdown__trigger user-link">
        <span class="c-primary-nav__link nav-link-span">
            <i class="fas fa-user" id="icon-user" aria-hidden="true"></i>
        </span>
    </a>
';
?>