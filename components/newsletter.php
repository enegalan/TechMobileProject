<?php
include 'lang/detect_lang.php';

echo '
    <section id="newsletters">
        <h3>' . $lang['looking_for_best_smartphones'] . '</h3>
        <p>' . $lang['suscribe_newsletters'] . '</p>
        <form action="" method="POST">
            <div>
                <input class="newsletters_input" type="text" placeholder="' . $lang["email"] . '">
                <button class="newsletters_submit" type="submit">' . $lang['i_suscribe'] . '</button>
            </div>
            <div>
                <input type="checkbox" name="accept_conditions" id="accept_conditions">
                <label for="accept_conditions">' . $lang['accept_newsletters_conditions'] . '</label>
            </div>
        </form>
    </section>
';