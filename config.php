<?php

$CFG = new stdClass;

$CFG->database = [
    'connection' => 'mysql:host=127.0.0.1',
    'database'   => 'magivax',
    'username'   => 'root', //'magivax_user',
    'password'   => '', //'anti-anti-vax',
    'options'    => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]
];
