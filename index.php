<?php

require 'core/setup.php';
require Router::load('routes.php')
    ->direct(trim($_SERVER['REQUEST_URI'], '/'));

