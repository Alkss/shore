<?php

$postCode = $_POST['postcode'];
$file = file_get_contents('../assets/json/postalcode.json');
$json = json_decode($file);

foreach ($json as $address){
    if ($address->pc == $postCode){
        echo $address->value;
        die();
    }
}

