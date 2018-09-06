<?php

return [
    'database' => [
        'connection' => 'mysql:host=localhost:8889',
        'name'       => 'magivax',
        'username'   => 'magivax_user',
        'password'   => 'anti-anti-vax',
        'options'    => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]
    ]
];
