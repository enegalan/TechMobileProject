<?php 
include 'lang/detect_lang.php';
$colors = [
    'black' => $lang['black'],
    'white' => $lang['white'], 
    'grey' => $lang['grey'], 
    'spacegrey' => $lang['spacegrey'], 
    'gold' => $lang['gold'], 
    'silver' => $lang['silver'], 
    'rosegold' => $lang['rosegold'], 
    'green' => $lang['green'], 
    'purple' => $lang['purple'], 
    'red' => $lang['red'], 
    'yellow' => $lang['yellow'], 
    'blue' => $lang['blue'], 
    'bronce' => $lang['bronce'], 
    'orange' => $lang['orange'],
];

$list_colors = '';

foreach($colors as $color => $colorName) {
    $list_colors .= '
    <input type="checkbox" class="color-options" id="option-' . $color . '" color="option-' . $color . '" value="' . $color . '">
    <label for="option-' . $color . '">' . $colorName .'</label>
    ';
}

?>