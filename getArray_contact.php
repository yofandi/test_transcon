<?php 
$customers = ['rio', 'ari', 'yuki'];

$contacts = [
    'ari' => '84684646',
    'dewi' => '47464524',
    'beni' => '4734526',
    'rio' => '47464524',
    'fitri' => '74563734',
];

$customerKeys = array_flip($customers);

foreach ($customerKeys as $key => $value) {
    if (!isset($contacts[$key])) {
        echo $key.": no contact";
    } else {
        echo $key.": ".$contacts[$key]."<br>";
    }
}