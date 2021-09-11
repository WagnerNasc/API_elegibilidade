<?php

use App\Models\User;

    $url = 'http://127.0.0.1/api/public_html/api/';

    $class = '/user';
    $param = '/3';

    // file_get_contents concatena e cria uma requisição HTTP
    $response = file_get_contents($url.$class.$param);

    //echo $response;

    // JSON -> ARRAY (PHP)
    //$response = json_decode($response, 1);

    //var_dump($response['data']['email']);

?>