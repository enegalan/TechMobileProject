<?php
include 'lang/detect_lang.php';

echo '
    <section id="manufacturer">
        <h3>' . $lang['find_by_manufacturer'] .'</h3>
        <div class="manufacturers_list">
        ' . 
            include 'php/list_manufacturers.php'; 
            foreach($manufacturers as $manufacturer) {
                echo '<div class="manufacturer_article articulo"><a href="manufacturer.php?id=' . $manufacturer['id'] . '">' . 
                    '<div style="display:flex;justify-content:center;width:100%;height:50%"><img class="manufacturer_logo" src="productos/' . $manufacturer['name'] . '/logo.png"></div>'
                    . '<div style="display:flex;justify-content:center;align-items:center;width:100%;height:50%;border-top: 1px solid grey;"><span>' . ucfirst($manufacturer['name']) . '</span></div>'
                    . '</a></div>';
            }
        ?>
        </div>
    </section>
';