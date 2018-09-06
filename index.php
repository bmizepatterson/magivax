<?php

require 'core/setup.php';
require Router::load('routes.php')
    ->direct(Request::uri());

