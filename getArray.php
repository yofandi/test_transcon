<?php
$data = [
    [
        'no_transaction' => '001',
        'items' => [
            ['name' => 'Milk', 'total' => 4],
            ['name' => 'Coffee', 'total' => 2],
        ],
    ],
    [
        'no_transaction' => '002',
        'items' => [
            ['name' => 'Tea', 'total' => 7],
            ['name' => 'Sugar', 'total' => 1],
            ['name' => 'Coffee', 'total' => 5],
        ],
    ],
];

for ($i=0; $i < count($data); $i++) {
    $itemTransac = $data[$i]['items'];
    echo $data[$i]['no_transaction'].'<br>';

    foreach ($itemTransac as $key) {
        echo $key['name'].' ('.$key['total'].')<br>';
    } 
    if ($i < count($data) - 1) { 
        echo '<br>';
    }
}