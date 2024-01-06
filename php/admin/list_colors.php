<?php 
$colors = [
    'black' => 'Black',
    'white' => 'White', 
    'grey' => 'Grey', 
    'spacegrey' => 'Space Grey', 
    'gold' => 'Gold', 
    'silver' => 'Silver', 
    'rosegold' => 'Rosegold', 
    'green' => 'Green', 
    'purple' => 'Purple', 
    'red' => 'Red', 
    'yellow' => 'Yellow', 
    'blue' => 'Blue', 
    'bronce' => 'Bronce', 
    'orange' => 'Orange',
];

$list_colors = '';

foreach($colors as $color => $colorName) {
    $list_colors .= '
    <input type="checkbox" class="color-options" id="option-' . $color . '" color="option-' . $color . '" value="' . $color . '">
    <label for="option-' . $color . '">' . $colorName .'</label>
    ';
}

?>